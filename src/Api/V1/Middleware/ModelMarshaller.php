<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Middleware;


use JeremyGiberson\Coolsurfin\Api\V1\Response\ModelResponse;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Hydrator\ClassMethods;

class ModelMarshaller
{
    public function __invoke(Request $request, Response $response, callable $callable){
        $result = $callable($request, $response);
        if (!$result instanceof ModelResponse){
            return $result;
        }

        $hydrator = new ClassMethods();
        $data = $hydrator->extract($result->getModel());

        // some day this could be based on accept content type
        $response->write(json_encode($data));
        return $response;
    }
}