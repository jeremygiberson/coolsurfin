<?php


namespace Coolsurfin\Unit\Api\V1\Controller;


use JeremyGiberson\Coolsurfin\Controller\IndexController;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_200_response(){
        $twig = new Twig(__DIR__ . '/fixtures');
        $controller = new IndexController($twig);

        $environment = Environment::mock();
        $request = Request::createFromEnvironment($environment);
        $response = new Response;

        /** @var Response $return */
        $return = $controller($request, $response);
        $this->assertInstanceOf(Response::class, $return);
        $this->assertEquals(200, $return->getStatusCode());
    }
}
