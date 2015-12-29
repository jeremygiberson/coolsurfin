<?php


namespace Coolsurfin\Unit;


use Pimple\Container;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class RouteProviderTestCase extends \PHPUnit_Framework_TestCase
{
    use MockRequestTrait;
    /** @var  App */
    protected $app;
    /** @var  Container */
    protected $container;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->app = new App();
        $this->container = $this->app->getContainer();

    }

    protected function factory_for_mock_middleware_with_expected_invocation(){
        $middleware_mock = $this->getMock('stdClass', ['__invoke']);

        $middleware_mock->expects($this->once())
            ->method('__invoke')
            ->with($this->isInstanceOf(Request::class),
                $this->isInstanceOf(Response::class));
        return function() use ($middleware_mock) { return $middleware_mock; };
    }

}