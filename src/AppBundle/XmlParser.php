<?php
/**
 * Created by PhpStorm.
 * User: nacta_000
 * Date: 23.01.2016
 * Time: 22:01
 */

namespace AppBundle;

use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Publication;
use AppBundle\Record;

class XmlParser
{

    private $xml;
    private $records;

    public function __construct($xml){
        $this->xml = $xml;
    }

    public function getPublications(){

    }

    public function getRecords(){
        $crawler = new Crawler();
        $crawler->addXmlContent($this->xml, "Windows-1251");
        $records = $crawler->first();
        $publications = null;
         foreach ($records as $record){
             $record = new Record($record);
             $publication = new Publication();
             $publication->setLanguage($record->getField('FIELD.102'));
             $publication->setTitle($record->getSubField('FIELD.200', 1));
             $publication->setAuthor($record->getSubField('FIELD.200', 3));
             $publication->setYear($record->getSubField('FIELD.210', 1));
             $publication->setCity($record->getSubField('FIELD.210', 2));

             var_dump($publication);
        }

        //var_dump($crawler);
    }



    public function createPublication($record){
        $publication = new Publication(

        );
        return $publication;
    }
}