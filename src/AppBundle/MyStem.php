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
    function mystem($q) {
        $out = array();
        $q = iconv("utf-8", "windows-1251", $q);
//echo stem('snowball');
        $path =  dirname(__FILE__) . '\mystem\mystem.exe';
        //exec('echo ' . $q . ' | ' . $path . ' -i', $out);

        $result = exec('echo "'.$q.'" | ' .$path . ' -dl -e cp866 ');
        $result = iconv("cp866", "windows-1251", $result);
//var_dump($result) ;
        //exec('echo '  . $path. ' -i', $out);
        $result = explode('{', $result);
        //$result = preg_match('/(?<={)[А-Я|а-я]+/g', $result);
       foreach ($result as $info){
           if (!is_null($info))
           {//echo $info.PHP_EOL . "_";
               $i = preg_replace('/[}?]/','', $info);

              // $i = explode(['=', '?='], $info);
           //$end = (strpos($info,'?') < strpos($info,'=')) ? strpos($info,'?') : strpos($info,'=');
               //$end = (!strpos($info,'?=')) ? strpos($info,'=') : strpos($info,'?=');
              // $end = strpos($info,'?');
               //if $end > strpos($info,'=')) ? strpos($info,'?') : strpos($info,'=')
               echo $i . PHP_EOL;
               phpinfo();
           //$i = substr($info, strpos($info,'{')+1, $end-2);
          // preg_match('/(?<={).+(?=[=|?])/',$info, $matches);
           //echo PHP_EOL . $i."*" . PHP_EOL;
           }
        }
        //var_dump($result);
        //echo $path;

        return $q;
    }


}