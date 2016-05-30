<?php

namespace app\api\requests;


use Phpro\SoapClient\Type\RequestInterface;

class LogoutRequest implements RequestInterface{

    public $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

}