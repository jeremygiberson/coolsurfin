<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Response;


use JeremyGiberson\Coolsurfin\Api\V1\Validator\ValidationResult;
use Slim\Http\Response;

class ValidationResponse extends Response
{
    private $validation_result;

    public function __construct(ValidationResult $validation_result)
    {
        parent::__construct(400);
        $this->validation_result = $validation_result;
    }

    /**
     * @return ValidationResult
     */
    public function getValidationResult()
    {
        return $this->validation_result;
    }
}