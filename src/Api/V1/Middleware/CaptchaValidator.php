<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Middleware;


use JeremyGiberson\Coolsurfin\Api\V1\Validator\ValidatorInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CaptchaValidator
{
    /** @var  ValidatorInterface */
    protected $validator;

    /**
     * CaptchaValidator constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function __invoke(Request $request, Response $response, callable $callable){
        $validation = $this->validator->validate($request->getParams());
        if($validation->isValid()){
            return $callable($request, $response);
        }

        $response = $response->withStatus(403);
        $response->write(json_encode([
            'errors' => ['You did not pass human verification']
        ]));


    }
}