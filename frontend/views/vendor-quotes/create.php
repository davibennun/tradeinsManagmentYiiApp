<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\VendorQuotes */

$this->title = 'Create Vendor Quotes';
$this->params['breadcrumbs'][] = ['label' => 'Vendor Quotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-quotes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
