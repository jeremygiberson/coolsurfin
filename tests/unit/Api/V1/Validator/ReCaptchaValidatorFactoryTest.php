<?php


namespace Coolsurfin\Unit\Api\V1\Validator;


use Coolsurfin\Unit\MockRequestTrait;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\ReCaptchaValidator;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\ReCaptchaValidatorFactory;
use Pimple\Container;

class ReCaptchaValidatorFactoryTest extends \PHPUnit_Framework_TestCase
{
    use MockRequestTrait;

    public function test_it_returns_recaptcha_validator()
    {
        $_ENV['RECAPTCHA_SECRET'] = 'foo';

        $factory = new ReCaptchaValidatorFactory();
        $instance = $factory(new Container([
            'request' => $this->mockRequest('/')
        ]));
        $this->assertInstanceOf(RecaptchaValidator::class, $instance);
    }
}
