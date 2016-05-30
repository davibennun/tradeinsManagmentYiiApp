<?php


namespace app\api\tradein;


use app\components\MapperInterface;

class LoginMapper implements MapperInterface{

    public function map($response)
    {
        return new LoginResponse($response);
    }

}