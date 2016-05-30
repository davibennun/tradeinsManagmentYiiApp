<?php


namespace app\commands;

use app\api\tradein\LoginRequest;
use app\api\tradein\TradeinFormInfoPaginatedRequest;
use Yii;
use yii\console\Controller;
use app\models\Tradein;
use app\components\TradeinClientFacade as TradeinSoapClient;

class TradeinController extends Controller{


    public function actionImport(){

        $lastTradein = Tradein::find()->limit(1)->orderby('id DESC')->one();

        $session_id = TradeinSoapClient::login(new LoginRequest('trade_in_test_1', '5s%3$_c>qWw7%.KQ'));

        $tradeinsResponse = TradeinSoapClient::tradeinFormInfoPaginated(new TradeinFormInfoPaginatedRequest($session_id, 1, 999, 1, 1));

        TradeinSoapClient::logout(new LogoutRequest($session_id));


        foreach ($tradeinsResponse->tradeins as $tradein) {
            try {
                var_dump($tradein);
                $tradein->save();
            } catch (\Exception $e) {
                Yii::error($e->getMessage());
            }
        }

    }
    
    
}