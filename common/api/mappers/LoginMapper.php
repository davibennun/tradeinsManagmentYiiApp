<?php

namespace common\api\mappers;


use common\api\responses\LoginResponse;
use common\api\components\MapperInterface;

class LoginMapper implements MapperInterface{

    public function map($response)
    {
        return new LoginResponse($response);
    }

}