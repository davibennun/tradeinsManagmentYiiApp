<?php

namespace common\api\requests;


use Phpro\SoapClient\Type\RequestInterface;

class LoginRequest implements RequestInterface
{

    /**
     * @var \SoapParam
     */
    public $username;

    /**
     * @var \SoapParam
     */
    public $apiKey;

    public function __construct($username, $apiKey)
    {
        $this->username = new \SoapParam($username, 'username');
        $this->apiKey = new \SoapParam($apiKey, 'apiKey');
    }

}