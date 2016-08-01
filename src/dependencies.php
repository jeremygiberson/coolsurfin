<?php
// DIC configuration

use Coolsurfin\Models\Comment;
use Coolsurfin\Routes\IndexRoute;
use Coolsurfin\Routes\NewCommentRoute;
use Coolsurfin\Routes\PostRoute;
use Doctrine\ORM\EntityManager;
use Slim\Views\Twig;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// Register component on container
$container['view'] = function ($container) {
    $view = new Twig(__DIR__ . '/../templates', [
        'debug' => true,
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

$container['em'] = function ($container) {
    $config = $container['settings']['doctrine'];
    $metaConfig = call_user_func($config['metadata']['configCallable'], $config['metadata']['paths'], $config['metadata']['devMode']);

    return EntityManager::create($config['connection'], $metaConfig);
};

$container['.env'] = function($container) {
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
    $dotenv->load();
    return $dotenv;
};

$container[IndexRoute::class] = function($container) {
    $em = $container['em'];
    $repository = $em->getRepository(Comment::class);
    $view = $container['view'];
    return new IndexRoute($view, $repository);
};

$container[PostRoute::class] = function($container) {
    $em = $container['em'];
    $repository = $em->getRepository(Comment::class);
    $view = $container['view'];
    return new PostRoute($view, $repository);
};

$container[NewCommentRoute::class] = function($container) {
    $em = $container['em'];
    $router = $container['router'];
    return new NewCommentRoute($em, $router);
};