<?php


namespace Coolsurfin\Unit\View;


use JeremyGiberson\Coolsurfin\View\TwigProvider;
use Pimple\Container;
use Slim\Http\Request;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig;

class TwigProviderTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_provides_a_twig_instance(){
        $container = new Container();
        $container['router'] = $this->getMock(RouterInterface::class);
        $container['request'] = $this->getMock(Request::class, [], [], '', false);

        $provider = new TwigProvider();
        $provider->register($container);
        $this->assertTrue(isset($container['view']));
        $this->assertInstanceOf(Twig::class, $container['view']);
    }
}
