<?php


namespace Coolsurfin\Unit\Api\V1\Middleware;


class CaptchaValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function test_it_returns_next_middleware_response_on_valid_captcha(){}

    public function test_it_returns_403_response_on_invalid_captcha(){}
}
