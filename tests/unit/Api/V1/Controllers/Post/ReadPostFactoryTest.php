<?php


namespace Coolsurfin\Unit\Api\V1\Controllers\Post;


use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\ReadPost;
use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\ReadPostFactory;
use Pimple\Container;

class ReadPostFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function test_it_returns_a_read_post_instance(){
        $factory = new ReadPostFactory();
        $pimple = new Container;
        $this->assertInstanceOf(ReadPost::class, $factory($pimple));
    }
}
