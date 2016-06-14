<?php

namespace common\api\mappers;


use common\api\responses\TradeinFormInfoPaginatedResponse;
use common\api\components\MapperInterface;
use common\models\Tradein;
use yii\helpers\ArrayHelper;

/**
 * Maps soap raw response to active record models
 * Class TradeinFormInfoPaginatedMapper
 * @package app\api\mappers
 */
class TradeinFormInfoPaginatedMapper implements MapperInterface{

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
            $tradeinArray['id'] = ArrayHelper::getValue($tradeinArray, 'tradeins_id');
            unset($tradeinArray['tradeins_id']);

            $tradeinArray['creation_time'] = ArrayHelper::getValue($tradeinArray, 'created_time');
            unset($tradeinArray['created_time']);

            $tradeinArray['brand'] = ArrayHelper::getValue($tradeinArray, 'watch_brand');
            unset($tradeinArray['watch_brand']);

            $tradeinArray['box_papers'] = ArrayHelper::getValue($tradeinArray, 'box_or_papers');
            unset($tradeinArray['box_or_papers']);

            $tradeinArray['info_newitem_customer_wants'] = ArrayHelper::getValue($tradeinArray, 'information');
            unset($tradeinArray['information']);

            $tradeinArray['purchase_date'] = \DateTime::createFromFormat('Y-m-d H:i:s', $tradeinArray['purchase_date'])->format('Y-m-d');

            // Quick and dirty image format conversion
            $tradeinArray['image5'] = ArrayHelper::getValue($tradeinArray, 'image4');
            $tradeinArray['image4'] = ArrayHelper::getValue($tradeinArray, 'image3');
            $tradeinArray['image3'] = ArrayHelper::getValue($tradeinArray, 'image2');
            $tradeinArray['image2'] = ArrayHelper::getValue($tradeinArray, 'image1');
            $tradeinArray['image1'] = ArrayHelper::getValue($tradeinArray, 'image0');





            //criar imported_at e colocar como default now() e deixar o creation_time como importado, e nao permitir editalo na ui

            // Create Active Record instance
            $model = new Tradein();
            $model->load($tradeinArray,'');

            // Sets id manually
            $model->id = $tradeinArray['id'];

            $tradeins[] = $model;

        }

        $response = new TradeinFormInfoPaginatedResponse($tradeins);
        return $response;

    }

}