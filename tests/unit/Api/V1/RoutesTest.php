<?php


namespace Coolsurfin\Unit\Api\V1;


use Coolsurfin\Unit\RouteProviderTestCase;
use JeremyGiberson\Coolsurfin\Api\V1\Routes;


class RoutesTest extends RouteProviderTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function test_it_maps_post_read() {
        $routes = new Routes();
        $routes->register($this->app);

        $this->mock_request('/api/v1/posts/');
        $this->container['read_post_factory'] = $this->factory_for_mock_middleware_with_expected_invocation();
        $this->app->run(true);
    }

    public function test_it_maps_post_create(){
        $routes = new Routes();
        $routes->register($this->app);

        $this->mock_request('/api/v1/posts/', 'POST');
        $this->container['create_post_factory'] = $this->factory_for_mock_middleware_with_expected_invocation();
        $this->app->run(true);
    }
}
