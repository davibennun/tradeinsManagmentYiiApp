<?php

namespace app\api\mappers;


use app\api\responses\LoginResponse;
use app\components\MapperInterface;

class LoginMapper implements MapperInterface{

    public function map($response)
    {
        return new LoginResponse($response);
    }

}