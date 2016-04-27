<?php
/**
 * Created by PhpStorm.
 * User: nacta_000
 * Date: 15.02.2016
 * Time: 8:55
 */

namespace AppBundle;


class MyStem
{
    protected $stopwords;
    
    public function __construct()
    {
        $this->loadWords();
    }

    function mystem($q, $lang) {
        if ($lang == 'en')
            $stem = stem($q);
        else if ($lang == 'ru')
            $stem = stem_russian_unicode($q);
            else $stem = '';
     return $stem;
    }

    function prepareField($field){
        echo  '___________________' .  $field;
        $words = explode(' ', $field);
        $stems = [];
        foreach ($words as $word){
            $stem =  $this->mystem($word, 'ru');
            $stem =str_replace(['.', ','], '', $stem);
            if ((strlen($stem) > 1) && !$this->isStopWord($stem))
                $stems[] = $stem;
        }
        return $stems;
    }

    function loadWords(){
        $words = [];
        $handle = @fopen(__DIR__ . "/resources/stopwords.txt", "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $word = mb_convert_encoding($buffer, "Windows-1251", "UTF-8");
                $word =$this->mystem($word, 'ru');
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