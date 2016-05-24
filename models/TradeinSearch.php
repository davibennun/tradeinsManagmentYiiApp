<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tradein;
use yii\data\ArrayDataProvider;

/**
 * TradeinSearch represents the model behind the search form about `app\models\Tradein`.
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
            [['first_contact', 'last_contact'], 'default', 'value' => null],
            [['first_contact', 'last_contact'], 'date', 'format' => 'php:Y-m-d'],
            [['first_name', 'last_name', 'first_contact', 'last_contact', 'model_number'], 'safe'],
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

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_contact', $this->first_contact])
            ->andFilterWhere(['like', 'last_contact', $this->last_contact])
            ->andFilterWhere(['like', 'model_number', $this->model_number]);

        return $dataProvider;
    }
}
