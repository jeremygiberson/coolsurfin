<?php


namespace Coolsurfin\Unit\Api\V1\Validator;


use JeremyGiberson\Coolsurfin\Api\V1\Validator\ReCaptchaValidator;
use ReCaptcha\ReCaptcha;
use ReCaptcha\Response;

class ReCaptchaValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_valid_result()
    {
        /** @var ReCaptcha $recaptcha */
        $recaptcha = $this->getMock(ReCaptcha::class, [], [], '', false);
        $recaptcha->expects($this->any())
            ->method('verify')
            ->with($data = 'foo')
            ->willReturn($response = new Response(true));

        $validator = new ReCaptchaValidator($recaptcha, 'ip');
        $result = $validator->validate($data);
        $this->assertTrue($result->isValid());
        $this->assertEmpty($result->getErrors());
    }

    public function test_it_returns_invalid_result()
    {
        /** @var ReCaptcha $recaptcha */
        $recaptcha = $this->getMock(ReCaptcha::class, [], [], '', false);
        $recaptcha->expects($this->any())
            ->method('verify')
            ->with($data = 'foo')
            ->willReturn($response = new Response(false, $e = ['errors']));

        $validator = new ReCaptchaValidator($recaptcha, 'ip');
        $result = $validator->validate($data);
        $this->assertFalse($result->isValid());
        $this->assertEquals($e, $result->getErrors());
    }
}
