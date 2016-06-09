<?php

use common\widgets\Alert;
use yii\helpers\Html;
use kartik\grid\GridView as KartikGridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchVendorQuotes */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendor Quotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-quotes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= Alert::widget() ?>

    <p>
        <?= Html::a('Create a Vendor Quote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= KartikGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['class' => kartik\grid\EditableColumn::class, 'attribute' => 'brand'],
            ['class' => kartik\grid\EditableColumn::class, 'attribute' => 'model'],
            ['class' => kartik\grid\EditableColumn::class, 'attribute' => 'price'],

            ['class' => 'yii\grid\ActionColumn', 'visibleButtons' => [
                'view' => false,
                'update' => false,
            ]],
        ],
    ]); ?>
</div>
