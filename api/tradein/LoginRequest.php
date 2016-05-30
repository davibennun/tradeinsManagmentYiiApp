<?php


namespace app\api\tradein;


use Phpro\SoapClient\Type\RequestInterface;

class LoginRequest implements RequestInterface
{

    public $username;

    public $apiKey;

    public function __construct($username, $apiKey)
    {
        $this->username = new \SoapParam($username, 'username');
        $this->apiKey = new \SoapParam($apiKey, 'apiKey');
    }

}