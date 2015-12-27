<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Middleware;


use JeremyGiberson\Coolsurfin\Api\V1\Exception\EntityNotFound;
use Slim\Http\Request;
use Slim\Http\Response;

class EntityNotFoundMiddleware
{
    public function __invoke(Request $request, Response $response, callable $next) {
        try {
            return $next($request, $response);
        } catch (EntityNotFound $e) {
            return $response->withStatus(404, $e->getMessage());
        }
    }
}