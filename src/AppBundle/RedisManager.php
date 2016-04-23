<?php
/**
 * Created by PhpStorm.
 * User: anastasia
 * Date: 20.04.16
 * Time: 23:36
 */

namespace AppBundle;

use Nette\Utils\Tokenizer;
use AppBundle\Model\Publication;

require realpath("../predis/autoload.php");


class RedisManager
{
    protected $redis;
    protected $stopwords;
    protected $data;

    public function  __construct(){
        $this->redis = $this->connect();
        $this->loadWords();
        $this->redis->flushall();

;    }

    private function connect(){
        \Predis\Autoloader::register();
        try {
            $redis = new \Predis\Client();
        }
        catch (\Exception $e) {
            die($e->getMessage());
        }
        return $redis;
    }

    public function savePublication(Publication $publication){
       // var_dump($publication);
        $stem_title = $this->prepareField($publication->getTitle());
        $stem_author = $this->prepareField($publication->getAuthor());
        $stem_city = $this->prepareField($publication->getCity());

        foreach ($stem_author as $stem){
           // echo $stem . '<br>';
            $this->redis->sadd('author:' . $stem, $publication->getId());
        }

        foreach ($stem_city as $stem){
            $this->redis->sadd('city:' . $stem, $publication->getId());
        }

        $stems = array_merge($stem_author, $stem_city, $stem_title);
        $stems = array_unique($stems);

        foreach ($stems as $stem){
            $this->redis->sadd($stem, $publication->getId());
        }


        $this->redis->sadd("author:Марценюк", "blablabla");
        var_dump($this->redis->smembers("author:Марценюк"));



        // var_dump( $this->redis->scan(0));

    }

    function prepareField($field){
        $words = explode(' ', $field);
        $myStem = new MyStem();
        $stems = [];
        $re = "/[^а-яА-Яa-zA-Z]/";
        foreach ($words as $word){
            $stem =  $myStem->mystem($word, 'ru');
           // $stem = preg_replace($re, '', $stem);
            $stem =str_replace(['.', ','], '', $stem);
            if ((strlen($stem) > 1) && !$this->isStopWord($stem))
                $stems[] = $stem;
        }
        return $stems;
    }

    function loadWords(){
        $words = [];
        $handle = @fopen(__DIR__ . "/resources/stopwords.txt", "r");
        $myStem = new MyStem();
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $word = mb_convert_encoding($buffer, "Windows-1251", "UTF-8");
                $word =$myStem->mystem($word, 'ru');

                    $words[] = $word;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
        else echo 'error';

        $this->stopwords = $words;
    }

    function isStopWord($word){
        foreach ($this->stopwords as $stopword){
            if ($stopword == $word)
                return true;
        }
        return false;
    }


}

