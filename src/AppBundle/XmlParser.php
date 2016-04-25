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
        $xml = simplexml_load_string($this->xml);
        foreach ($xml as $record) {
            print_r($record);
            echo '<br/>';
        }
        die;
//        $crawler = new Crawler();
//        $crawler->addXmlContent($this->xml, "Windows-1251");
//        $records = $crawler->children();
////        $publications = null;
////         foreach ($records as $record){
//        /** @var Crawler $record */
//        $publications = [];
//        foreach ($records as $record) {
//            $publication = new Publication();
//            $publication->setLanguage($this->getField($record, 'FIELD.102'));
//            $publication->setTitle($this->getField($record, 'FIELD.200'));
//            $publication->setAuthor($this->getField($record, 'FIELD.200'));
//            $publication->setYear($this->getField($record, 'FIELD.210'));
//            $publication->setCity($this->getField($record, 'FIELD.210'));
//
//            $publications[] = $publication;
//        }
//
//        print_r($publications); die;

        //var_dump($crawler);
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