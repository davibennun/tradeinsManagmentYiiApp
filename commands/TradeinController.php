<?php


namespace app\commands;

use Yii;
use app\api\tradein\GetTradeinCollectionRequest;
use app\api\tradein\TradeinClient;
use Phpro\SoapClient\ClientBuilder;
use Phpro\SoapClient\ClientFactory;
use Phpro\SoapClient\Soap\ClassMap\ClassMap;
use yii\console\Controller;
use app\models\Tradein;

class TradeinController extends Controller{


    public function actionImport(){
        $lastTradeinId = Tradein::find()->limit(1)->orderby('id DESC')->one();


        $wsdl = Yii::getAlias('@app').'/api/tradein/tradein.wsdl';
        $clientFactory = new ClientFactory(TradeinClient::class);
        $soapOptions = [
            'cache_wsdl' => WSDL_CACHE_NONE
        ];


        $clientBuilder = new ClientBuilder($clientFactory, $wsdl, $soapOptions);
        $clientBuilder->addClassMap(
            new ClassMap('Tradein', Tradein::class)
        );
        $client = $clientBuilder->build();

        $tradeinCollection = $client->getTradeinCollection(new GetTradeinCollectionRequest(''));

        foreach($tradeinCollection as $tradein){
            try{
                $tradein->save();
            }catch(\Exception $e){
                Yii::error($e->getMessage());
            }

        }


    }
    
    
}