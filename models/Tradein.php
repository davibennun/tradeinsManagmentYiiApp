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
            [['customeritem_if_new', 'customeritem_retail_value', 'customeritem_vendor_offer', 'customeritem_jomashop_offer', 'purchase_date', 'purchased_from', 'box_papers', 'condition', 'image1', 'image2', 'image3', 'image4', 'image5', 'info_newitem_customer_wants', 'newitem_cost', 'newitem_jomashop_currentprice', 'outofpocket_price'], 'safe'],
            [['first_name', 'last_name', 'model_number', 'brand', 'email','shipping_label','phone','brand','other_brand','model','model_number'], 'string', 'max' => 255],
            [['internal_notes', 'contact_notes'], 'string','max'=>65535],
            [['first_contact', 'last_contact', 'email', 'customeritem_if_new', 'customeritem_retail_value', 'customeritem_vendor_offer', 'customeritem_jomashop_offer', 'purchase_date', 'purchased_from', 'box_papers', 'condition', 'image1', 'image2', 'image3', 'image4', 'image5', 'info_newitem_customer_wants', 'newitem_cost', 'newitem_jomashop_currentprice', 'outofpocket_price'], 'default', 'value' => null],
            [['email'], 'email', 'skipOnEmpty'=>true],
            [['first_contact','last_contact', 'purchase_date'], 'date', 'format'=>'php:Y-m-d'],
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


    public function lastInserted()
    {
        return $this->find()->limit(1)->orderby('id DESC')->one();
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
            'model_number' => 'Model number',
            'customeritem_if_new' => 'Customer item is new',
            'customeritem_retail_value' => 'Customer item retail value',
            'customeritem_vendor_offer' => 'Customer vendor offer',
            'customeritem_jomashop_offer' => 'Customer item jomashop offer',
            'purchase_date' => 'Purchase date',
            'purchased_from' => 'Purchased from',
            'box_papers' => 'Box papers',
            'condition' => 'Condition',
            'image1' => 'Image #1',
            'image2' => 'Image #2',
            'image3' => 'Image #3',
            'image4' => 'Image #4',
            'image5' => 'Image #5',
            'info_newitem_customer_wants' => 'New item customer wants',
            'newitem_cost' => 'New item cost',
            'newitem_jomashop_currentprice' => 'New item jomashop current price',
            'outofpocket_price' => 'Out of pocket price',
            'creation_time' => 'Creation time',
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
                'model_number' => Faker::numerify('######'),
                'customeritem_if_new' => Faker::boolean(),
                'customeritem_retail_value' => Faker::numerify('###'),
                'customeritem_vendor_offer' => Faker::numerify('###'),
                'customeritem_jomashop_offer' => Faker::numerify('###'),
                'purchase_date' => Faker::date(),
                'purchased_from' => Faker::name(),
                'box_papers' => Faker::randomElement(['yes','no']),
                'condition' => Faker::randomElement(['new','used','refurbished']),
                'image1' => 'http://placehold.it/140x100?text=not+set+1',
                'image2' => 'http://placehold.it/140x100?text=not+set+2',
                'image3' => 'http://placehold.it/140x100?text=not+set+3',
                'image4' => 'http://placehold.it/140x100?text=not+set+4',
                'image5' => 'http://placehold.it/140x100?text=not+set+5',
                'info_newitem_customer_wants' => Faker::word(),
                'newitem_cost' => Faker::numerify('###'),
                'newitem_jomashop_currentprice' => Faker::numerify('###'),
                'outofpocket_price' => Faker::numerify('###')
            ]
        ];
    }

}
