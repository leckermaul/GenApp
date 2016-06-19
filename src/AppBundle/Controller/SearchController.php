<?php
/**
 * Created by PhpStorm.
 * User: a.akkuzova
 * Date: 27.04.16
 * Time: 18:42
 */

namespace AppBundle\Controller;

use AppBundle\MyStem;
use AppBundle\RedisManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    /**
     * @Route("/search")
     */
    public function search()
    {
        return $this->render('default/search.html.twig',array(
            'searchString' => '',
        ));
    }

    public function processQuery(){
    if (isset($_GET['button'])) {
        $searchString = $_GET['data'];
        $query = $this->prepareQuery($searchString);
        $redisManager = new RedisManager();
        $documents = [];
        foreach ($query as $word) {
            $documents = array_merge($redisManager->searchDocuments($word), $documents);
        }
        $documents = array_unique($documents);
        var_dump($documents);
        foreach ($documents as $document) {
            echo '__________' . $document . '<br>';
        }
    }
}

    protected function prepareQuery($searchString)
    {
        $myStem = new MyStem();
        $query = $myStem->prepareField($searchString);
        return $query;
    }


}