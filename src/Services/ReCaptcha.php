<?php


namespace Coolsurfin\Services;


use GuzzleHttp\Client;

class ReCaptcha
{
    /** @var  Client */
    private $client;
    /** @var  string */
    private $secret;
    /** @var  string */
    private $remoteIp;

    /**
     * ReCaptcha constructor.
     * @param Client $client
     * @param string $secret
     * @param string $remoteIp
     */
    public function __construct(Client $client, $secret, $remoteIp)
    {
        $this->client = $client;
        $this->secret = $secret;
        $this->remoteIp = $remoteIp;
    }


    public function IsVerified($recaptcha)
    {
        $response = $this->client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => $this->secret,
                'response' => $recaptcha,
                'remoteip' => $this->remoteIp
            ]
        ]);
        if ($response->getStatusCode() != 200) {
            return false;
        }
        $result = json_decode($response->getBody(), true);
        return @$result['success'] == true;
    }
}