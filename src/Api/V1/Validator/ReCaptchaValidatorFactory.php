<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Validator;

use Pimple\Container;
use ReCaptcha\ReCaptcha;
use Slim\Http\Request;

class ReCaptchaValidatorFactory
{
    public function __invoke(Container $container)
    {
        /** @var Request $request */
        $request = $container['request'];
        $ip_address = $request->getServerParams()['REMOTE_ADDR'];
        $secret = $_ENV['RECAPTCHA_SECRET'];
        $recaptcha = new ReCaptcha($secret);
        return new ReCaptchaValidator($recaptcha, $ip_address);
    }
}