<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\grid\GridView as KartikGridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TradeinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tradeins';
$this->params['breadcrumbs'][] = $this->title;

function genColumn($attr, $opt=[], $inputType=\kartik\editable\Editable::INPUT_TEXT, $inputTypeOptions=[])
{
    return array_merge([
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>$attr,
        'editableOptions'=>function($model, $key, $index) use ($inputType, $inputTypeOptions){
            return [
                'inputType'=>$inputType,
                'options'=>$inputTypeOptions
            ];
        },
        'vAlign'=>'middle',
        'pageSummary'=>true
    ], $opt);
}


?>
<div class="tradein-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        echo KartikGridView::widget([
            'dataProvider'=> $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                genColumn('first_name'),
                genColumn('last_name'),
                genColumn('first_contact',['format'=>'date'], \kartik\editable\Editable::INPUT_DATE),
                genColumn('last_contact',['format'=>'date'], \kartik\editable\Editable::INPUT_DATE),
                genColumn('model_number'),
            ],
            'responsive'=>true,
            'hover'=>true,
            'export' => false
        ]);
    ?>

</div>
