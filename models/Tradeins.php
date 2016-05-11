<?php

namespace app\models;

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
class Tradeins extends \yii\db\ActiveRecord
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
}
