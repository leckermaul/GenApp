<?php
/**
 * Created by PhpStorm.
 * User: anastasia
 * Date: 20.04.16
 * Time: 23:36
 */

namespace AppBundle;

require realpath("../predis/autoload.php");


class RedisManager
{
    public function connect(){
        \Predis\Autoloader::register();
echo realpath("../predis/autoload.php");
        try {
            $redis = new \Predis\Client();
        }
        catch (\Exception $e) {
            die($e->getMessage());
        }
        return $redis;
    }
}

