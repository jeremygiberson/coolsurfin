<?php


namespace Coolsurfin\Unit\Api\V1;


use Coolsurfin\Unit\RouteProviderTestCase;
use JeremyGiberson\Coolsurfin\Api\V1\Routes;


class RoutesTest extends RouteProviderTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->container['captcha_validator'] = function(){
            return function($request, $response, $callable){
                return $callable($request, $response);
            };
        };
        $_ENV['RECAPTCHA_SECRET'] = 'foo';
    }

    public function test_it_maps_post_read()
    {
        $this->markTestSkipped('need a better way to test route mapping');
        $this->container['request'] = $this->mockRequest('/api/v1/posts/', 'GET');

        $routes = new Routes();
        $routes->register($this->app);

        $this->container['read_post_factory'] = $this->factory_for_mock_middleware_with_expected_invocation();
        $this->app->run(true);
    }

    public function test_it_maps_post_create()
    {
        $this->markTestSkipped('need a better way to test route mapping');
        $this->container['request'] = $this->mockRequest('/api/v1/posts/', 'POST');

        $routes = new Routes();
        $routes->register($this->app);

        $this->container['create_post_factory'] = $this->factory_for_mock_middleware_with_expected_invocation();
        $this->app->run(true);
    }
}
