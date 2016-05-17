<?php


namespace app\components;


use Phpro\SoapClient\ClientBuilder;
use Phpro\SoapClient\ClientFactory;
use Phpro\SoapClient\Soap\ClassMap\ClassMap;

class SoapComponent {

    public $clients = [];

    public function register($clientName, $fullWsdlPath, $classMaps=[],$options)
    {
        $clientInfo = [
            'clientName'=> $clientName,
            'wsdl'=> $fullWsdlPath,
            'options'=> $options,
            'classMaps'=>$classMaps
        ];
        $this->clients[] = $clientInfo;

        return $this;
    }

    public function addClassMap($clientName, $type, $class)
    {
        $this->clients[$clientName]['classMaps'][] = [$type, $class];

        return $this;
    }

    public function build($clientName, $rebuild=false)
    {
        //check if client was already built
        if(isset($this->info($clientName)['theClient']) && !$rebuild){
            return $this->info($clientName)['theClient'];
        }

        $clientInfo = $this->info($clientName);
        $clientFactory = new ClientFactory($clientInfo['clientName']);
        $clientBuilder = new ClientBuilder($clientFactory, $clientInfo['wsdl'], $clientInfo['options']);
        foreach($clientInfo['classMaps'] as $classMap)
        {
            $clientBuilder->addClassMap(new ClassMap($classMap[0], $classMap[1]));
        }

        $clientInfo['factory'] = $clientFactory;
        $clientInfo['builder'] = $clientBuilder;
        $clientInfo['theClient'] = $clientBuilder->build();

        $this->addInfo($clientInfo);

        return $clientInfo['theClient'];
    }

    public function info($clientName){
        return current(array_filter($this->clients, function($clientInfo) use ($clientName){
            return $clientInfo['clientName'] == $clientName;
        }));
    }

    public function addInfo($clientInfo)
    {
        //Remove $cilentInfo from $this->clients (in case it exsits)
        $clientsClean = array_filter($this->clients, function ($client) use ($clientInfo) {
            return $client['clientName'] != $clientInfo['clientName'];
        });

        $clientsClean[] = $clientInfo;

        $this->clients = $clientsClean;
    }

}