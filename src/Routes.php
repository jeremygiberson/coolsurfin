<?php


namespace JeremyGiberson\Coolsurfin;


use JeremyGiberson\Coolsurfin\Controllers\IndexFactory;
use JeremyGiberson\Coolsurfin\Router\RoutesProviderInterface;
use Slim\App;

class Routes implements RoutesProviderInterface
{

    public function register(App $app)
    {
        $container = $app->getContainer();
        $container['home'] = new IndexFactory;

        $app->get('/', 'home')->setName('home');
    }
}