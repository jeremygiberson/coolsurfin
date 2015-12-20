<?php


namespace Coolsurfin\Unit\Controllers;


use JeremyGiberson\Coolsurfin\Controllers\IndexController;
use JeremyGiberson\Coolsurfin\Controllers\IndexFactory;
use Pimple\Container;

class IndexFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_provides_an_index_controller(){
        $factory = new IndexFactory();
        $controller = $factory(new Container());
        $this->assertInstanceOf(IndexController::class, $controller);
    }
}
