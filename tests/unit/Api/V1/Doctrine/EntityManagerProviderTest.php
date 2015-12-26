<?php


namespace Coolsurfin\Unit\Api\V1\Doctrine;


use JeremyGiberson\Coolsurfin\Api\V1\Doctrine\EntityManagerProvider;
use Pimple\Container;

class EntityManagerProviderTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_provides_entity_manager(){
        $container = new Container();
        $provider = new EntityManagerProvider();
        $provider->register($container);
        $this->assertTrue(isset($container['entity_manager']));
    }
}
