<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Middleware;


use JeremyGiberson\Coolsurfin\Api\V1\Validator\ValidationResult;
use Slim\Http\Request;
use Slim\Http\Response;

class ValidationMarshaller
{
    public function __invoke(Request $request, Response $response, callable $callable){
        $result = $callable($request, $response);

        if(! $result instanceof ValidationResult){
            return $result;
        }

        $response = $response->withStatus(400);
        // some day this could be based on accept content type
        $response->write(json_encode([
            'errors' => $result->getErrors()
        ]));
        return $response;
    }
}