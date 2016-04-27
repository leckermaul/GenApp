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

    public function __construct($record)
    {
        $this->record = $record;
    }

    function getField($fieldName)
    {
        try {
            return $this->record->getElementsByTagName($fieldName)->item(0)->nodeValue;
        } catch (\Exception $e) {
            return null;
        }

    }

    function getSubField($fieldName, $num)
    {
        try{
            return $this->record->getElementsByTagName($fieldName)->item(0)->childNodes->item($num)->nodeValue;
        }
        catch (\Exception $e){
            return null;
        }
    }
}