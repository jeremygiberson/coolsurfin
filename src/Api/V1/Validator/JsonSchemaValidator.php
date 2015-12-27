<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Validator;


use JsonSchema\Uri\UriRetriever;
use JsonSchema\Validator;

class JsonSchemaValidator implements ValidatorInterface
{
    protected $schema;

    /**
     * JsonSchemaValidator constructor.
     * @param $schema
     */
    public function __construct($schema)
    {
        $this->schema = $schema;
    }


    /**
     * @param $data
     * @return ValidationResult
     */
    public function validate($data)
    {
        $validator = new Validator();
        $validator->check($data, $this->schema);

        if ($validator->isValid()) {
            return new ValidationResult(true);
        }

        return new ValidationResult(false, $validator->getErrors());
    }
}