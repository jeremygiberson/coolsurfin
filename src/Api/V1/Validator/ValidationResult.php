<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Validator;


class ValidationResult
{
    /** @var  bool */
    private $valid;
    /** @var  string[] */
    private $errors;

    /**
     * ValidationResult constructor.
     * @param bool $valid
     * @param \string[] $errors
     */
    public function __construct($valid, array $errors = [])
    {
        $this->valid = $valid;
        $this->errors = $errors;
    }

    public function isValid() {
        return $this->valid;
    }

    public function getErrors(){
        return $this->errors;
    }
}