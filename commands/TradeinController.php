<?php


namespace app\commands;

use Yii;
use app\api\tradein\GetTradeinCollectionRequest;
use Phpro\SoapClient\ClientBuilder;
use Phpro\SoapClient\ClientFactory;
use Phpro\SoapClient\Soap\ClassMap\ClassMap;
use yii\console\Controller;
use app\models\Tradein;
use app\components\TradeinClientFacade as TradeinSoapClient;

class TradeinController extends Controller{


    public function actionImport(){
        $lastTradein = Tradein::find()->limit(1)->orderby('id DESC')->one();

        $tradeins = TradeinSoapClient::getTradeinCollection(new GetTradeinCollectionRequest($lastTradein->id));

        foreach($tradeins as $tradein){
            try{
                $tradein->save();
            }catch(\Exception $e){
                Yii::error($e->getMessage());
            }

        }


    }
    
    
}