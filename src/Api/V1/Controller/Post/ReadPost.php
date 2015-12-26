<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controller\Post;


use Slim\Http\Request;
use Slim\Http\Response;

class ReadPost
{
    public function __invoke(Request $request, Response $response) {
        return $response->write('foobar');
    }
}