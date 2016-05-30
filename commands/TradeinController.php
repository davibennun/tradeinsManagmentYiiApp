<?php


namespace app\commands;

use app\api\requests\LoginRequest;
use app\api\requests\LogoutRequest;
use app\api\requests\TradeinFormInfoPaginatedRequest;
use Yii;
use yii\console\Controller;
use app\models\Tradein;
use app\components\TradeinClientFacade as TradeinSoapClient;

class TradeinController extends Controller{


    public function actionImport(){

        // Get the last incremented inserted tradein id, if there's no tradeins in table set it to 0
        $lastTradein = Tradein::find()->limit(1)->orderby('id DESC')->one();
        $lastInsertedId = $lastTradein ? $lastTradein->id : 0;
        $lastInsertedId++;
        // Logs in
        $session_id = TradeinSoapClient::login(new LoginRequest('trade_in_test_1', '5s%3$_c>qWw7%.KQ'));


        // Request just one tradein after the last inserted one
        $request = new TradeinFormInfoPaginatedRequest($session_id, $lastInsertedId, PHP_INT_MAX, 1, 1);

        // Make the request, gets the tradein and saves it, sets the startingFromId to this just inserted tradein
        // and make the request again until it return an empty array, meaning that there's no more tradeins
        while ($tradeins = TradeinSoapClient::tradeinFormInfoPaginated($request)->tradeins) {
            foreach ($tradeins as $tradein) {
                if($tradein->save())
                    print_r($tradein->id);
            }
            $request->setStartingTradeinFormId($tradein->id + 1);
        }

        // Logs out
        TradeinSoapClient::logout(new LogoutRequest($session_id));

    }
    
    
}