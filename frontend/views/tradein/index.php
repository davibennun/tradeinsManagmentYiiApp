<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\grid\GridView as KartikGridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TradeinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tradeins';
$this->params['breadcrumbs'][] = $this->title;

\kartik\detail\DetailViewAsset::register(Yii::$app->getView());


?>
<div class="tradein-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        echo KartikGridView::widget([
            'dataProvider'=> $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column) {
                        return \kartik\grid\GridView::ROW_COLLAPSED;
                    },
                    'detail' => function ($model, $key, $index, $column) {
                        return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model,'key'=>$key,'index'=>$index]);
                    },
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'expandOneOnly' => true,
                    'enableRowClick' => true
                ],
                [
                    'attribute'=> 'first_name',
                    'contentOptions' => function ($model, $key, $index, $column){
                        return ['id' => 'td-tradein-'.$index.'-'.$column->attribute];
                    }
                ],
                [
                    'attribute'=> 'last_name',
                    'contentOptions' => function ($model, $key, $index, $column){
                        return ['id' => 'td-tradein-'.$index.'-'.$column->attribute];
                    }
                ],
                [
                    'attribute'=>'first_contact',
                    'format'=> ['date', 'php:m-d-Y'],
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
                    }
                ],
                [
                    'attribute'=>'last_contact',
                    'format'=> ['date', 'php:m-d-Y'],
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
                    }
                ],
                [
                    'attribute'=>'model_number',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
                    }
                ],
            ],
            'responsive'=>true,
            'hover'=>true,
            'export' => false,
        ]);
    ?>

</div>
