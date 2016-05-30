<?php

namespace app\api;

use app\components\MapperInterface;
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

    protected function call($method, RequestInterface $request, MapperInterface $mapper = null)
    {
        $requestEvent = new Event\RequestEvent($this, $method, $request);
        $this->dispatcher->dispatch(Events::REQUEST, $requestEvent);

        try {
            /**
             * Because of a weird behaviour of SoapClient I can't call the soap method like this
             * $soapClient->$method($request);
             * Instead I have to extract the public vars of $request and call $method and pass them as arguments:
             * $soapClient->$method($requestPublicAttr1, $requestPublicAttr2, $requestPublicAttr3 ...)
             */
            $attrs = $this->getPublicAttrs($request);
            $result = call_user_func_array([$this->soapClient, $method], $attrs);

            $result = $mapper ? $mapper->map($result) : $result;

            if ($result instanceof ResultProviderInterface) {
                $result = $result->getResult();
            }
        } catch (SoapFault $soapFault) {
            $this->dispatcher->dispatch(Events::FAULT, new Event\FaultEvent($this, $soapFault, $requestEvent));
            throw $soapFault;
        }

//        $this->dispatcher->dispatch(Events::RESPONSE, new Event\ResponseEvent($this, $requestEvent, $result));
        return $result;
    }

    private function getPublicAttrs($obj)
    {
        $publicProperties = (new \ReflectionClass($obj))->getProperties();
        //Get public properties of obj
        $attrs = array_map(function ($prop) {
            return $prop->name;
        }, $publicProperties);

        // Mount an array of field => value
        $attrsValues = array_map(function ($field) use ($obj) {
            return $obj->$field;
        }, $attrs);

        return $attrsValues;
    }


}