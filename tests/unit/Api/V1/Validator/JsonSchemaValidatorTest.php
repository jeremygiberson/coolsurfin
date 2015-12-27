<?php


namespace Coolsurfin\Unit\Api\V1\Validator;


use JeremyGiberson\Coolsurfin\Api\V1\Validator\JsonSchemaValidator;

class JsonSchemaValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function test_it_returns_valid_result(){
        $validator = new JsonSchemaValidator(
            json_decode(file_get_contents(__DIR__ . '/fixtures/schema.json')));
        $data = (object)['foo' => 'bar'];
        $result = $validator->validate($data);
        $this->assertTrue($result->isValid());
    }

    public function test_it_returns_invalid_result(){
        $validator = new JsonSchemaValidator(
            json_decode(file_get_contents(__DIR__ . '/fixtures/schema.json')));
        $data = (object)['bar' => 'foo'];
        $result = $validator->validate($data);
        $this->assertFalse($result->isValid());
        $this->assertNotEmpty($result->getErrors());
    }
}
