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
use Symfony\Component\HttpFoundation\Response;

class SearchController
{
    /**
     * @Route("/search")
     */
    public function search()
    {
        $form = <<<FORM
        <form>
            <input name="data" type="text" value="%s" size=100>
            <input name="button" type="submit" value="Send">
        </form>
FORM;

        echo sprintf($form, isset($_GET['data']) ? $_GET['data'] : '');

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

        return new Response(
            '<html><body></body></html>'
        );
    }

    protected function prepareQuery($searchString)
    {
        $myStem = new MyStem();
        $query = $myStem->prepareField($searchString);
        return $query;
    }


}