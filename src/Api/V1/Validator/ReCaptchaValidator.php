<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Validator;


use ReCaptcha\ReCaptcha;

class ReCaptchaValidator implements ValidatorInterface
{
    /** @var  ReCaptcha */
    private $recaptcha;
    /** @var  string */
    private $remote_ip;

    /**
     * ReCaptchaValidator constructor.
     * @param ReCaptcha $recaptcha
     * @param string $remote_ip
     */
    public function __construct(ReCaptcha $recaptcha, $remote_ip)
    {
        $this->recaptcha = $recaptcha;
        $this->remote_ip = $remote_ip;
    }


    /**
     * @param $data
     * @return ValidationResult
     */
    public function validate($data)
    {
        $response = $this->recaptcha->verify($data, $this->remote_ip);
        if($response->isSuccess()){
            return new ValidationResult(true);
        }
        return new ValidationResult(false, $response->getErrorCodes());
    }
}