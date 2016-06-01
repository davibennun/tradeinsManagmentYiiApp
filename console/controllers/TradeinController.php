<?php

namespace console\controllers;

use common\api\clients\JomaShopClientFacade as JomaShopClient;
use common\api\requests\LoginRequest;
use common\api\requests\LogoutRequest;
use common\api\requests\TradeinFormInfoPaginatedRequest;
use common\models\Tradein;
use yii\console\Controller;
use Yii;

class TradeinController extends Controller{

    /**
     * @var \common\models\Tradein
     */
    public $tradein;

    public function __construct($id, $module, $config = [], Tradein $tradein)
    {
        $this->tradein = $tradein;
        parent::__construct($id, $module, $config);
    }

    public function actionImport()
    {
        // Get the last incremented inserted tradein id, if there's no tradeins in table set it to 0
        $lastTradein = $this->tradein->lastInserted();
        $lastInsertedId = $lastTradein ? $lastTradein->id : 0;
        $lastInsertedId++;
        // Logs in
        $session_id = JomaShopClient::login(new LoginRequest(Yii::$app->params['jomaShopSoapUsername'], Yii::$app->params['jomaShopSoapApiKey']));
        // Request just one tradein after the last inserted one
        $request = new TradeinFormInfoPaginatedRequest($session_id, $lastInsertedId, PHP_INT_MAX, 1, 1);
        // Make the request, gets the tradein and saves it, sets the startingFromId to this just inserted tradein
        // and make the request again until it return an empty array, meaning that there's no more tradeins
        while ($tradeins = JomaShopClient::tradeinFormInfoPaginated($request)->tradeins) {
            foreach ($tradeins as $tradein) {
                if ($tradein->save())
                    print_r($tradein->id);
            }
            $request->setStartingTradeinFormId($tradein->id + 1);
        }
        // Logs out
        JomaShopClient::logout(new LogoutRequest($session_id));
    }

}