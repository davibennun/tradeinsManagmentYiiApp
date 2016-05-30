<?php


namespace app\components;


use app\api\clients\TradeinClient;

class TradeinClientFacade extends SoapClientFacade{

    public function getClientName()
    {
        return TradeinClient::class;
    }

}