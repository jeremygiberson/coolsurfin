<?php


namespace Coolsurfin\Unit\Api\V1\Storage;


use Doctrine\ORM\EntityManager;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageInterface;
use Pimple\Container;

class PostStorageFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_a_post_storage()
    {
        $container = new Container();
        $container['entity_manager'] = $this->getMock(EntityManager::class,
            [], [], '', false);
        $factory = new PostStorageFactory();
        $instance = $factory($container);
        $this->assertInstanceOf(PostStorageInterface::class, $instance);
    }
}
