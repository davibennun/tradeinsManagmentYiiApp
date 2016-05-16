<?php

namespace app\models;

use saada\FactoryMuffin\FactoryInterface;
use League\FactoryMuffin\Faker\Facade as Faker;
use Phpro\SoapClient\Type\ResultInterface;
use Yii;

/**
 * This is the model class for table "tradeins".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $watch
 * @property string $model
 * @property string $brand
 * @property string $value
 */
class Tradein extends \yii\db\ActiveRecord implements FactoryInterface, ResultInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tradeins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'watch', 'value'], 'required'],
            [['first_name', 'last_name', 'watch', 'model', 'brand', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'watch' => 'Watch',
            'model' => 'Model',
            'brand' => 'Brand',
            'value' => 'Value',
        ];
    }

    public static function definitions() {
        return [
             [
                'first_name'=> Faker::firstName(),
                'last_name'=> Faker::lastName(),
                'watch' => Faker::word(),
                'model' => Faker::word(),
                'brand' => Faker::company(),
                'value' => Faker::numerify('###')
            ]
        ];
    }

}
