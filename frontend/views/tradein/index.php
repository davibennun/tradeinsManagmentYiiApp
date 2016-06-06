<?php

use common\models\Tradein;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\grid\GridView as KartikGridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TradeinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tradeins';
$this->params['breadcrumbs'][] = $this->title;

\kartik\detail\DetailViewAsset::register(Yii::$app->getView());

$attr = (new Tradein())->attributeLabels();
unset($attr['status']);
$exportColumns = array_keys($attr);
$exportColumns[] = [
    'attribute' => 'status',
    'value' => function ($model, $key, $index, $widget) {
        $labels = [
            '10' => 'Active',
            '20' => 'Inactive',
            '30' => 'Closed',
            '40' => 'Successful',
        ];
        return $labels[$model->status];
    }
];

?>
<div class="tradein-index">

    <h1>
        <?= Html::encode($this->title) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => array_merge($exportColumns),
        'showColumnSelector' => false,
        'exportConfig' => ['HTML' => false, 'TXT' => false, 'PDF' => false, 'Excel5' => false, 'Excel2007' => false],
        'fontAwesome' => true,
        'target' => ExportMenu::TARGET_SELF,
        'dropdownOptions' => [
            'label' => 'Export',
            'class' => 'btn btn-default'
        ]
    ])
    ?>
    </h1>
    <hr/>
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
                    'attribute'=> 'status',
                    'contentOptions' => function ($model, $key, $index, $column){
                        return ['id' => 'td-tradein-'.$index.'-'.$column->attribute];
                    },
                    'format'=>'raw',
                    'value' => function ($model, $key, $index, $widget){
                        $labels = [
                            '10' => '<span class="label label-primary">Active</span>',
                            '20' => '<span class="label label-default">Inactive</span>',
                            '30' => '<span class="label label-danger">Closed</span>',
                            '40' => '<span class="label label-success">Successful</span>',
                        ];
                        return $labels[$model->status];
                    },
                    'filterType' => KartikGridView::FILTER_SELECT2,
                    'filter' => ['10' => 'Active',
                        '20' => 'Inactive',
                        '30' => 'Closed',
                        '40' => 'Successful',],
                    'filterWidgetOptions' => [
                        'hideSearch'=>true,
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => 'Select status'],
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
