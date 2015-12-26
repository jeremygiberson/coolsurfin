<?php


namespace Coolsurfin\Unit\Api\V1\Controllers\Post;


use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\CreatePost;
use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\CreatePostFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageInterface;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\ValidatorInterface;
use Pimple\Container;

class CreatePostFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function test_it_returns_a_create_post_instance()
    {
        $factory = new CreatePostFactory();
        $container = new Container();
        $container['post_storage'] = $this->getmock(PostStorageInterface::class);
        $container['post_validator'] = $this->getMock(ValidatorInterface::class);

        $controller = $factory($container);
        $this->assertInstanceOf(CreatePost::class, $controller);
    }
}
