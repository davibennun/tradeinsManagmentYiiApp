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

    public $dateFormatter = ['display'=>'m-d-Y','save'=>'Y-m-d'];

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
            [['first_name', 'last_name', 'model_number', 'brand', 'email','shipping_label','phone','brand','other_brand','model','model_number'], 'string', 'max' => 255],
            [['internal_notes', 'contact_notes'], 'string','max'=>65535],
            [['first_contact','last_contact','email'], 'default', 'value' => null],
            [['email'], 'email', 'skipOnEmpty'=>true],
            [['first_contact','last_contact'], 'date', 'format'=>'php:Y-m-d'],
        ];
    }

    /**
     * Mainly to format dates
     */
    public function beforeValidate()
    {
        parent::beforeValidate();
        // Get model date values based on rules
        foreach($this->rules() as $rule){
            $fields = $rule[0];
            $type = $rule[1];
            if($type == 'date'){
                foreach($fields as $field){
                    if(empty($field)) continue;
                    $theDate = \DateTime::createFromFormat($this->dateFormatter['display'], $this->$field);
                    // Formats date only if its valid
                    if (\DateTime::getLastErrors()['error_count'] == 0) {
                        $this->$field = $theDate->format($this->dateFormatter['save']);
                    }
                }
            }
        }
        return true;
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
            'internal_notes' => 'Internal notes',
            'first_contact' => 'First contact',
            'last_contact' => 'Last contact',
            'contact_notes'=> 'Contact notes',
            'shipping_label'=> 'Shipping label',
            'email'=>'Email',
            'phone'=>'Phone',
            'brand'=>'Brand',
            'other_brand'=>'Other brand',
            'model' => 'Model',
            'model_number' => 'Model number'
        ];
    }

    public static function definitions() {
        return [
             [
                'first_name'=> Faker::firstName(),
                'last_name'=> Faker::lastName(),
                'model' => Faker::word(),
                'brand' => Faker::company(),
                'internal_notes' => Faker::paragraph(),
                'first_contact' => Faker::date(),
                'last_contact' => Faker::date(),
                'contact_notes'=> Faker::paragraph(),
                'shipping_label'=> Faker::uuid(),
                'email' => Faker::email(),
                'phone'=>Faker::phoneNumber(),
                'other_brand'=> Faker::company(),
                'model_number' => Faker::numerify('######')
            ]
        ];
    }

}
