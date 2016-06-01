<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tradein */

$this->title = 'Update Tradein: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tradeins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tradein-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
