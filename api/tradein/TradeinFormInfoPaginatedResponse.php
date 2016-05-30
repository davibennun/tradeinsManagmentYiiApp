<?php


namespace app\api\tradein;


use Phpro\SoapClient\Type\ResultInterface;

class TradeinFormInfoPaginatedResponse implements ResultInterface{

    public $tradeins = [];

    public function __construct($tradeins)
    {
        $this->tradeins = $tradeins;
    }

}