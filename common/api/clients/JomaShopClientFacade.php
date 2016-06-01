<?php


namespace common\api\clients;

use common\api\components\SoapClientFacade;


class JomaShopClientFacade extends SoapClientFacade{

    public function getClientName()
    {
        return JomaShopClient::class;
    }

}