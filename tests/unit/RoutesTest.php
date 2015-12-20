<?php


namespace Coolsurfin\Unit;


use JeremyGiberson\Coolsurfin\Controllers\IndexController;
use JeremyGiberson\Coolsurfin\Routes;
use Slim\App;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouteInterface;
use Slim\Router;

class RoutesTest extends \PHPUnit_Framework_TestCase
{
    protected function mockRequest($path = '/', $method = 'GET'){
        $environment = Environment::mock([
            'REQUEST_URI' => $path,
            'REQUEST_METHOD' => $method
        ]);

        return Request::createFromEnvironment($environment);
    }

    protected function factory_for_mock_middleware_with_expected_invocation(){
        $middleware_mock = $this->getMock('stdClass', ['__invoke']);

        $middleware_mock->expects($this->once())
            ->method('__invoke')
            ->with($this->isInstanceOf(Request::class),
                $this->isInstanceOf(Response::class));
        return function() use ($middleware_mock) { return $middleware_mock; };
    }

    public function test_it_maps_home_to_index_middleware(){
        $app = new App();
        $container = $app->getContainer();
        $container['request'] = $this->mockRequest('/');

        $routes = new Routes();
        $routes->register($app);

        // override middleware
        $container['home'] = $this->factory_for_mock_middleware_with_expected_invocation();

        $app->run(true);
    }

    public function test_it_provides_named_home_route(){
        $app = new App();
        $routes = new Routes();
        $routes->register($app);
        /** @var Router $router */
        $router = $app->getContainer()->get('router');
        $this->assertInstanceOf(RouteInterface::class, $router->getNamedRoute('home'));
    }

    public function test_it_registers_a_factory_for_index_controller(){
        $app = new App();
        $routes = new Routes();
        $routes->register($app);
        $this->assertTrue($app->getContainer()->has('home'));
        $this->assertInstanceOf(IndexController::class, $app->getContainer()->get('home'));
    }
}
