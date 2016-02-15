<?php
/**
 * Created by PhpStorm.
 * User: nacta_000
 * Date: 23.01.2016
 * Time: 23:07
 */

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\XmlParser;
use AppBundle\MyStem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;


class XmlParserController
{

    /**
     * @Route("/parser")
     */
    public function executeParser()
    {
        //$xml = readfile("H:/exmple.xml", "r");
        /* $fh = fopen("H:/exmple.xml", "r");
         $xml = fpassthru($fh);*/
        $xml = file_get_contents("H:/example.xml", "r");
       // $xml = mb_convert_encoding($xml, 'HTML-ENTITIES', "UTF-8");
        //echo  mb_detect_encoding($xml, 'auto');
        //$xml = mb_convert_encoding($xml, "UTF-8", "Windows-1251");
        //echo $xml;
        //$xml = mb_convert_encoding($xml, "Windows-1251", "UTF-8");
        $parser = new XmlParser($xml);

        $parser->getRecords();
        $myStem = new MyStem();
         $myStem->mystem('Alice\'s Adventures in Wonderland (commonly shortened to Alice in Wonderland) is an 1865 novel written by English author Charles Lutwidge Dodgson under the pseudonym Lewis Carroll.[1] It tells of a girl n');
        return new Response(
            '<html><body></body></html>'
        );
    }

}