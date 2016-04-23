<?php
/**
 * Created by PhpStorm.
 * User: nacta_000
 * Date: 23.01.2016
 * Time: 23:07
 */

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\RedisManager;
use AppBundle\XmlParser;
use AppBundle\MyStem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;

//require realpath("../../predis/autoload.php");

class XmlParserController
{

    /**
     * @Route("/parser")
     */
    public function executeParser()
    {
        $xml = file_get_contents("../example.xml", "r");
        $parser = new XmlParser($xml);
        $publications  = $parser->getRecords();
        $myStem = new MyStem();
        echo $myStem->mystem('апельсинки', 'ru');
        $redisManager = new RedisManager();
        $redisManager->savePublication($publications[0]);
        return new Response(
            '<html><body></body></html>'
        );
    }

}