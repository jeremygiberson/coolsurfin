<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Validator;


use JsonSchema\Uri\UriRetriever;

class JsonSchemaValidatorFactory
{
    protected $schema;

    /**
     * JsonSchemaValidator constructor.
     */
    public function __construct($path_to_schema)
    {
        $retriever = new UriRetriever;
        $this->schema = $retriever->retrieve('file://' . $path_to_schema);
    }


    public function __invoke()
    {
        return new JsonSchemaValidator($this->schema);
    }
}