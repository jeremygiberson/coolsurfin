<?php


namespace JeremyGiberson\Coolsurfin;


use JeremyGiberson\Coolsurfin\Controllers\IndexFactory;
use Slim\App;

class Routes
{

    public function register(App $app)
    {
        $container = $app->getContainer();
        $container['home'] = new IndexFactory;

        $app->get('/', 'home')->setName('home');
    }
}