<?php
use JeremyGiberson\Coolsurfin\Routes;
use JeremyGiberson\Coolsurfin\View\TwigProvider;

require '../vendor/autoload.php';

date_default_timezone_set('UTC');


$app = new \Slim\App;

$twigProvider = new TwigProvider();
$twigProvider->register($app->getContainer());

$routes = new Routes();
$routes->register($app);

$app->run();