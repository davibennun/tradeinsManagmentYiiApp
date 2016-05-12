<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\grid\GridView as KartikGridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TradeinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tradeins';
$this->params['breadcrumbs'][] = $this->title;

function genColumn($attr, $opt=[])
{
    return array_merge([
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>$attr,
        'editableOptions'=>function($model, $key, $index){
            return [
                'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                'options'=>[]
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

    <p>
        <?= Html::a('Create Tradein', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        echo KartikGridView::widget([
            'dataProvider'=> $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                genColumn('first_name'),
                genColumn('last_name'),
                genColumn('watch'),
                genColumn('model'),
                genColumn('brand'),
                genColumn('value'),
            ],
            'responsive'=>true,
            'hover'=>true,
            'export' => false
        ]);
    ?>

</div>
