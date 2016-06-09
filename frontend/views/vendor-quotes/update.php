<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VendorQuotes */

$this->title = 'Update Vendor Quotes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Quotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendor-quotes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
