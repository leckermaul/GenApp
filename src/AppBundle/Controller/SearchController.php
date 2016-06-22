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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    /**
     * @Route("/search")
     */
    public function search(Request $request){
        $pressed = $request->get('button');
        if (isset($pressed)) {
            $searchString = $request->get('data');
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
            return $this->render('default/result.html.twig',array(
                'documents' => $documents,
            ));
    }
        return $this->render('default/search.html.twig',array(
            'searchString' => '',
        ));
    }

    protected function prepareQuery($searchString){
        $myStem = new MyStem();
        $query = $myStem->prepareField($searchString);
        return $query;
    }
    /**
     * @Route("/main")
     */
    public function main(Request $request){
        return $this->render('default/main.html.twig',array(
            'searchString' => '',
        ));
    }

    /**
     * @Route("/settings")
     */
    public function settings(Request $request){
        return $this->render('default/settings.html.twig',array(
            'searchString' => '',
        ));
    }

}