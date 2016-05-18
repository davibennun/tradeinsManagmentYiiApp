<?php

namespace app\api\tradein;

use app\api\BaseSoapClient;
use Phpro\SoapClient\Client;
use Phpro\SoapClient\Type\RequestInterface;

class TradeinClient extends BaseSoapClient
{
    /**
     * @param RequestInterface $request
     *
     * @return ResultInterface
     * @throws \SoapFault
     */
    public function getTradeinCollection(getTradeinCollectionRequest $request)
    {
        return $this->call('tradein.getTradeinCollection', $request);
    }
}