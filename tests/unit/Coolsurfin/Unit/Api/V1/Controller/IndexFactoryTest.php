<?php


namespace Coolsurfin\Unit\Api\V1\Controller;


use JeremyGiberson\Coolsurfin\Controller\IndexController;
use JeremyGiberson\Coolsurfin\Controller\IndexFactory;
use Pimple\Container;
use Slim\Views\Twig;

class IndexFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_provides_an_index_controller(){
        $factory = new IndexFactory();
        $container = new Container();
        $container['view'] = $this->getMock(Twig::class, [], [], '', false);
        $controller = $factory($container);
        $this->assertInstanceOf(IndexController::class, $controller);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function test_it_throws_exception_if_view_dependency_is_not_provided(){
        $factory = new IndexFactory();
        $factory(new Container());
    }
}
