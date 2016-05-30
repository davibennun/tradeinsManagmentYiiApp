<?php

namespace app\api\responses;


use Phpro\SoapClient\Type\ResultInterface;

class TradeinFormInfoPaginatedResponse implements ResultInterface{

    public $tradeins = [];

    public function __construct($tradeins)
    {
        $this->tradeins = $tradeins;
    }

}