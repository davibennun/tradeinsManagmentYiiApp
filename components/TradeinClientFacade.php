<?php


namespace app\components;


use app\api\tradein\TradeinClient;

class TradeinClientFacade extends SoapClientFacade{

    public function getClientName()
    {
        return TradeinClient::class;
    }

}