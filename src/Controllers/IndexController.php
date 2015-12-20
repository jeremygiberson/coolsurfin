<?php


namespace JeremyGiberson\Coolsurfin\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class IndexController
{
    public function __invoke(Request $request, Response $response){
        return $response->write('Hello Coolsurfin');
    }
}