<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Middleware;


use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;
use ReflectionClass;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Hydrator\ClassMethods;

class ModelMarshaller
{
    public function __invoke(Request $request, Response $response, callable $callable){
        $result = $callable($request, $response);
        $result_reflection = new ReflectionClass($result);
        $result_reflection->getNamespaceName();

        // any model in the namespace we care about transforming
        $model_reflection = new ReflectionClass(Post::class);
        if($result_reflection->getNamespaceName() != $model_reflection->getNamespaceName()){
            return $result;
        }

        $hydrator = new ClassMethods();
        $data = $hydrator->extract($result);

        $response = $response->withStatus(200);
        // some day this could be based on accept content type
        $response->write(json_encode($data));
        return $response;
    }
}