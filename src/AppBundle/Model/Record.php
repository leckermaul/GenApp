<?php
/**
 * Created by PhpStorm.
 * User: nacta_000
 * Date: 25.01.2016
 * Time: 0:42
 */

namespace AppBundle\Model;


class Record
{
    private $record;

    public function  __construct($record){
        $this->record = $record;
    }

    function getField($fieldName){
        return $this->record->getElementsByTagName($fieldName)->item(0)->nodeValue;
    }

    function getFirstSubField($fieldName){
        return $this->record->getElementsByTagName($fieldName)->item(0)->childNodes->item(1)->nodeValue;
    }

    function getSubField($fieldName, $num){
        return $this->record->getElementsByTagName($fieldName)->item(0)->childNodes->item($num)->nodeValue;
    }
}