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
        $xml = file_get_contents("../example.xml", "r");
        $parser = new XmlParser($xml);
        $parser->getRecords();
        $myStem = new MyStem();
        $myStem->mystem('мурилка');
        return new Response(
            '<html><body></body></html>'
        );
    }

}