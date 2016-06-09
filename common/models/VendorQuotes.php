<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vendor_quotes".
 *
 * @property integer $id
 * @property string $brand
 * @property string $model
 * @property string $price
 */
class VendorQuotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor_quotes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand', 'model'], 'required'],
            [['price'], 'number'],
            [['brand', 'model'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'price' => 'Price',
        ];
    }
}
