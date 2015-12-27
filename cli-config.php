<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use JeremyGiberson\Coolsurfin\Api\V1\Doctrine\EntityManagerProvider;
use Pimple\Container;

require_once 'vendor/autoload.php';

$container = new Container;
$provider = new EntityManagerProvider();
$provider->register($container);
/** @var EntityManager $entity_manager */
$entity_manager = $container['entity_manager'];



return $helperSet = ConsoleRunner::createHelperSet($entity_manager);


