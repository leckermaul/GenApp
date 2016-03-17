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
             $stem = stem($q);
      echo 'stem . ' . $stem;
//        return $q;//phpinfo();
    }


}