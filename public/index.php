<?php
use JeremyGiberson\Coolsurfin\Routes;

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

$routes = new Routes();

$app = new \Slim\App;
$routes->register($app);

$app->run();