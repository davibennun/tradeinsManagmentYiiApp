<?php


namespace app\components;


use app\api\clients\JomaShopClient;

class JomaShopClientFacade extends SoapClientFacade{

    public function getClientName()
    {
        return JomaShopClient::class;
    }

}