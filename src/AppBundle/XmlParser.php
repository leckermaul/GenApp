<?php
/**
 * Created by PhpStorm.
 * User: nacta_000
 * Date: 23.01.2016
 * Time: 22:01
 */

namespace AppBundle;

use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Model\Publication;
use AppBundle\Model\Record;

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
       // $crawler->addXmlContent($this->xml, "UTF-8");
//         foreach ($records as $record){
        /** @var Crawler $record */
        $publications = [];
        $crawler = $crawler->first();
        foreach ($crawler as $domElement) {
           $records = $domElement->getElementsByTagName("record");
            $publication = new Publication();
            foreach ($records as $record){
                var_dump($record);
                $record = new Record($record);
                $publication = new Publication();
                $publication->setLanguage($record->getField('FIELD.102'));
                $publication->setId($record->getField('FIELD.903'));
                $publication->setTitle($record->getSubField('FIELD.200', 1));
                $publication->setAuthor($record->getSubField('FIELD.200', 3));
                $publication->setYear($record->getSubField('FIELD.210', 1));
                $publication->setCity($record->getSubField('FIELD.210', 2));
                $publications[] = $publication;
                echo '<br><br>';
            }

           var_dump($publications);

        }
    }

    private function getField($record, $field) {
        return $record->getElementsByTagName($field)->item(0)->nodeValue;
    }




    public function createPublication($record){
        $publication = new Publication(

        );
        return $publication;
    }
}