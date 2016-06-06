<?php

use common\models\Tradein;
use kartik\dynagrid\DynaGrid;
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

    </h1>

    <?=
    DynaGrid::widget([
            'gridOptions' => [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsive' => true,
                'hover' => true,
                'panel'=>[
                    'heading'=>false
                ],
                'exportConfig' => [
                    KartikGridView::CSV => ['label' => 'Save as CSV'],
                    KartikGridView::EXCEL => ['label' => 'Save as Excel 2007+'],
                    ],
                'toolbar' => [
                    ['content' => '{dynagrid}'],
                    '{export}',
                ]
            ],
            'options' => ['id'=>'dynagrid-tradein-index-1'],
            'showPersonalize' => true,
            'columns' => [
                'first_name','last_name'
            ]

        ]);
    ?>

</div>
