<?php

namespace app\api;

use Phpro\SoapClient\Client;
use Phpro\SoapClient\Event;
use Phpro\SoapClient\Events;
use Phpro\SoapClient\Type\RequestInterface;
use Phpro\SoapClient\Type\ResultInterface;
use Phpro\SoapClient\Type\ResultProviderInterface;
use SoapClient;
use SoapFault;
use SoapHeader;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BaseSoapClient extends Client{

    protected function call($method, RequestInterface $request)
    {
        $requestEvent = new Event\RequestEvent($this, $method, $request);
        $this->dispatcher->dispatch(Events::REQUEST, $requestEvent);

        try {
            $result = $this->soapClient->$method($request);
            if ($result instanceof ResultProviderInterface) {
                $result = $result->getResult();
            }
        } catch (SoapFault $soapFault) {
            $this->dispatcher->dispatch(Events::FAULT, new Event\FaultEvent($this, $soapFault, $requestEvent));
            throw $soapFault;
        }

        //$this->dispatcher->dispatch(Events::RESPONSE, new Event\ResponseEvent($this, $requestEvent, $result));
        return $result;
    }

}