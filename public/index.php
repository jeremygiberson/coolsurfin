<?php
use JeremyGiberson\Coolsurfin\Routes;
use JeremyGiberson\Coolsurfin\View\TwigProvider;
use JeremyGiberson\Coolsurfin\Api\V1\Routes as ApiRoutes;

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);
$container = $app->getContainer();

$twigProvider = new TwigProvider();
$twigProvider->register($container);

$routes = new Routes();
$routes->register($app);

$api_routes = new ApiRoutes();
$api_routes->register($app);

$app->run();