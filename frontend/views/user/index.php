<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\grid\GridView as KartikGridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TradeinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

\kartik\detail\DetailViewAsset::register(Yii::$app->getView());


?>
<div class="tradein-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create new user', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?php
    echo KartikGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'username',
            'email',
        ],
        'responsive' => true,
        'hover' => true,
        'export' => false,
    ]);
    ?>

</div>
