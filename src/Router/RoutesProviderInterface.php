<?php


namespace JeremyGiberson\Coolsurfin\Router;


use Slim\App;

interface RoutesProviderInterface
{
    public function register(App $app);
}