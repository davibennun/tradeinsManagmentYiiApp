<?php

namespace app\api\tradein;

use Phpro\SoapClient\Type\RequestInterface;

class GetTradeinCollectionRequest implements RequestInterface{

    public function __construct($fromId){
        $this->fromId = $fromId;
    }

    public function __toString(){
        return (string) $this->fromId;
    }

}