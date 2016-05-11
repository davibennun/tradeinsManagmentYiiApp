<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tradein */

$this->title = 'Create Tradein';
$this->params['breadcrumbs'][] = ['label' => 'Tradeins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tradein-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
