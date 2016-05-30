<?php


namespace app\api\tradein;


use app\components\MapperInterface;

/**
 * Maps soap raw response to active record models
 * Class TradeinFormInfoPaginatedResponseMapper
 * @package app\api\tradein
 */
class TradeinFormInfoPaginatedResponseMapper implements MapperInterface{

    public function map($result)
    {
        $tradeins = [];

        foreach ($result as $tradeinObj) {

            // Convert obj to array
            $tradeinArray = json_decode(json_encode($tradeinObj), true);

            // Trim values
            $tradeinArray = array_map('trim', $tradeinArray);

            // Convert empty strings to nulls
            $tradeinArray = array_map(function ($value) { return $value === "" ? null : $value; }, $tradeinArray);

            // Prepare attributes
            $tradeinArray['id'] = $tradeinArray['tradeins_id'];
            unset($tradeinArray['tradeins_id']);

            $tradeinArray['purchase_date'] = \DateTime::createFromFormat('Y-m-d H:i:s', $tradeinArray['purchase_date'])->format('Y-m-d');

            //criar imported_at e colocar como default now() e deixar o creation_time como importado, e nao permitir editalo na ui

            // Create Active Record instance
            $model = new \app\models\Tradein();
            $model->load($tradeinArray,'');

            $tradeins[] = $model;

        }

        $response = new TradeinFormInfoPaginatedResponse($tradeins);
        return $response;

    }

}