<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tradein;
use yii\data\ArrayDataProvider;

/**
 * TradeinSearch represents the model behind the search form about `common\models\Tradein`.
 */
class TradeinSearch extends Tradein
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['status', 'first_name', 'last_name', 'model_number','brand', 'brand', 'email', 'shipping_label', 'phone', 'brand', 'other_brand', 'model', 'model_number', 'customeritem_if_new', 'customeritem_retail_value', 'customeritem_vendor_offer', 'customeritem_jomashop_offer', 'purchased_from', 'box_papers', 'condition', 'image1', 'image2', 'image3', 'image4', 'image5', 'info_newitem_customer_wants', 'newitem_cost', 'newitem_jomashop_currentprice', 'outofpocket_price'], 'safe'],
            [['first_contact', 'last_contact', 'purchase_date'], 'default', 'value' => null],
            [['first_contact', 'last_contact', 'purchase_date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tradein::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // Order, recent first
        $query->orderBy('id DESC');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        // Extract all fields from rules
        $fields = [];
        foreach($this->rules() as $rule){
            array_walk($rule[0], function($field) use (&$fields){
                $fields[] = $field;
            });
        }

        // Mount query
        foreach($fields as $field){
            $query->andFilterWhere(['like', $field, $this->$field]);
        }

        return $dataProvider;
    }
}
