<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Middleware;


use JeremyGiberson\Coolsurfin\Api\V1\Response\ValidationResponse;
use Slim\Http\Request;
use Slim\Http\Response;

class ValidationMarshaller
{
    public function __invoke(Request $request, Response $response, callable $callable) {
        $result = $callable($request, $response);

        if (!$result instanceof ValidationResponse) {
            return $result;
        }

        // some day this could be based on accept content type
        $response->write(json_encode([
            'errors' => $result->getValidationResult()->getErrors()
        ]));
        return $response;
    }
}