<?php


namespace app\api\tradein;


use Phpro\SoapClient\Type\ResultInterface;

class LoginResponse implements ResultInterface{

    public $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

}