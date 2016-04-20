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
    function mystem($q, $lang) {
        if ($lang == 'en')
            $stem = stem($q);
        else if ($lang == 'ru')
            $stem = stem_russian_unicode("апельсины");
            else $stem = '';
     return $stem;
    }


}