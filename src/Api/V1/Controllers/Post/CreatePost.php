<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controllers\Post;


use Slim\Http\Request;
use Slim\Http\Response;

class CreatePost
{
    public function __invoke(Request $request, Response $response){
        return $response->write('foo');
    }
}