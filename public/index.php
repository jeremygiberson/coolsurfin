<?php
use Faker\Factory;
use JeremyGiberson\Coolsurfin\Model\Post;
use JeremyGiberson\Coolsurfin\View\TwigProvider;
use Slim\Http\Request;
use Slim\Http\Response;

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

$app = new \Slim\App;
$app->get('/', function (Request $request, Response $response){
    return $response->write("Welcome to coolsurfin\n");
})->setName('home');

$app->run();