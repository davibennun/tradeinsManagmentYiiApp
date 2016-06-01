<?php

namespace common\api\responses;


use Phpro\SoapClient\Type\ResultInterface;

class LoginResponse implements ResultInterface{

    public $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

}