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




class RedisManager
{
    protected $redis;
    protected $myStem;
    protected $data;

    public function  __construct(){
        $this->redis = $this->connect();
        $this->myStem = new MyStem();
        //$this->redis->flushall();

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
        $stem_title = $this->myStem->prepareField($publication->getTitle());
        $stem_author = $this->myStem->prepareField($publication->getAuthor());
        $stem_city = $this->myStem->prepareField($publication->getCity());

        foreach ($stem_author as $stem){
           // echo $stem . '<br>';
            $this->redis->sadd('author:' . $stem, $publication->getId());
            echo 'author:' . $stem;
            var_dump($this->redis->smembers('author:' . $stem));
            echo '<br>';
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
    }
    
    public function searchDocuments($key){
        $documents = $this->redis->smembers($key);
        var_dump($documents);
        return $documents;
    }




}

