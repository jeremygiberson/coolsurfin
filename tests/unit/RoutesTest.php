<?php


namespace Coolsurfin\Unit;


use JeremyGiberson\Coolsurfin\Controller\IndexController;
use JeremyGiberson\Coolsurfin\Routes;
use Slim\App;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouteInterface;
use Slim\Router;

class RoutesTest extends RouteProviderTestCase
{

    public function test_it_maps_home_to_index_middleware(){
        $this->mock_request('/');

        $routes = new Routes();
        $routes->register($this->app);

        // override middleware
        $this->container['home'] = $this->factory_for_mock_middleware_with_expected_invocation();

        $this->app->run(true);
    }

    public function test_it_provides_named_home_route(){
        $routes = new Routes();
        $routes->register($this->app);
        /** @var Router $router */
        $router = $this->container['router'];
        $this->assertInstanceOf(RouteInterface::class, $router->getNamedRoute('home'));
    }

    public function test_it_registers_a_factory_for_index_controller(){
        $routes = new Routes();
        $routes->register($this->app);
        $this->assertTrue(isset($this->container['home']));
    }
}
