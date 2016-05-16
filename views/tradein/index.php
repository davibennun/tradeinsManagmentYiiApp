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
                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute'=>'first_contact',
                    'hAlign'=>'center',
                    'vAlign'=>'middle',
                    'format'=>['date','php:m-d-Y'],
                    'xlFormat'=>"mmm\\-dd\\, \\-yyyy",
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                    'editableOptions'=>[
                        'header'=>'Publish Date',
                        'size'=>'md',
                        'inputType'=>\kartik\editable\Editable::INPUT_WIDGET,
                        'widgetClass'=> 'kartik\datecontrol\DateControl',
                        'options'=>[
                            'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                            'displayFormat'=>'php:m-d-Y',
                            'saveFormat'=>'php:Y-m-d',
                            'options'=>[
                                'pluginOptions'=>[
                                    'autoclose'=>true
                                ]
                            ]
                        ]
                    ],
                ],
                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute'=>'last_contact',
                    'hAlign'=>'center',
                    'vAlign'=>'middle',
                    'format'=>['date','php:m-d-Y'],
                    'xlFormat'=>"mmm\\-dd\\, \\-yyyy",
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                    'editableOptions'=>[
                        'header'=>'Publish Date',
                        'size'=>'md',
                        'inputType'=>\kartik\editable\Editable::INPUT_WIDGET,
                        'widgetClass'=> 'kartik\datecontrol\DateControl',
                        'options'=>[
                            'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                            'displayFormat'=>'php:m-d-Y',
                            'saveFormat'=>'php:Y-m-d',
                            'options'=>[
                                'pluginOptions'=>[
                                    'autoclose'=>true
                                ]
                            ]
                        ]
                    ],
                ],
                genColumn('model_number'),
            ],
            'responsive'=>true,
            'hover'=>true,
            'export' => false
        ]);
    ?>

</div>
