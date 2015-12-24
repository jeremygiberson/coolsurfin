<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Validator;


interface ValidatorInterface
{
    /**
     * @param $data
     * @return ValidationResult
     */
    public function validate($data);
}