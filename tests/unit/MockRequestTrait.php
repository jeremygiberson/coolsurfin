<?php


namespace Coolsurfin\Unit;


use Slim\Http\Environment;
use Slim\Http\Request;

trait MockRequestTrait
{
    public function mockRequest($path, $method = 'GET', $params = [], $env = []){
        $data = array_merge($env, [
            'REQUEST_URI' => $path,
            'REQUEST_METHOD' => $method
        ]);

        if(in_array(strtoupper($method), ['POST','PUT'])){
            $data['CONTENT_TYPE'] = 'application/x-www-form-urlencoded';
            $_POST = $params;
        } else {
            $data['QUERY_STRING'] = http_build_query($params);
        }

        $environment = Environment::mock($data);

        return Request::createFromEnvironment($environment);
    }
}