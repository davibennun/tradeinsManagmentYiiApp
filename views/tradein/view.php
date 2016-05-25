<?php

use kartik\editable\Editable;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\detail\DetailView as KartikDetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tradein */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tradeins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



$gen = function($attr, $opt=[]) use ($model){
    return array_merge([
        'id'=> 'tradein-'.$attr,
        'model' => $model,
        'name' => 'Tradein[0]['.$attr.']',
        'value' => $model->$attr,
        'asPopover' => false,
        'header' => 'Name',
        'size' => 'md',
        'options' => ['class' => 'form-control']
    ], $opt);
};

?>
<div class="tradein-view">

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>ID</th>
            <td><?= $model->id; ?></td>
        </tr>
        <tr>
            <th>First Name</th>
            <td><?= Editable::widget($gen('first_name')); ?></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><?= Editable::widget($gen('last_name')); ?></td>
        </tr>
        <tr>
            <th>Internal notes</th>
            <td>
                <?= Editable::widget($gen('internal_notes', [
                    'asPopover' => false,
                    'name' => 'Tradein[0][internal_notes]',
                    'displayValue' => $model->internal_notes,
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'header' => 'Internal notes',
                    'submitOnEnter' => false,
                    'editableValueOptions'=>['style'=>'text-align:left'],
                    'options' => [
                        'class' => 'form-control',
                        'rows' => 5,
                        'style' => 'width:500px;text-align:left',
                        'placeholder' => 'Enter notes...'
                    ]
                ])); ?>

            </td>
        </tr>
        <tr>
            <th>First contact</th>
            <td><?= Editable::widget(
                    [
                        'model'=>$model,
                        'attribute' => 'first_contact',
                        'header' => 'First contact',
                        'asPopover' => false,
                        'format' => 'php:m-d-Y',
                        'size' => 'md',
                        'inputType' => Editable::INPUT_DATE,
                        'header' => 'First contact',
                        'size' => 'md',
                        'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
                        'widgetClass' => 'kartik\datecontrol\DateControl',
                        'options' => [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'displayFormat' => 'php:m-d-Y',
                            'saveFormat' => 'php:Y-m-d',
                            'options' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]
                        ]
                    ); ?></td>
        </tr>
        <tr>
            <th>Last contact</th>
            <td><?= Editable::widget(
                    [
                        'model' => $model,
                        'attribute' => 'last_contact',
                        'header' => 'Last contact',
                        'asPopover' => false,
                        'size' => 'md',
                        'inputType' => Editable::INPUT_DATE,
                        'header' => 'Last contact',
                        'size' => 'md',
                        'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
                        'widgetClass' => 'kartik\datecontrol\DateControl',
                        'options' => [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'displayFormat' => 'php:m-d-Y',
                            'saveFormat' => 'php:Y-m-d',
                            'options' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]
                    ]
                )?></td>
        </tr>
        <tr>
            <th>Contact notes</th>
            <td>
                <?= Editable::widget($gen('contact_notes', [
                    'asPopover' => false,
                    'name' => 'Tradein[0][contact_notes]',
                    'displayValue' => $model->contact_notes,
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'header' => 'Contact notes',
                    'editableValueOptions' => ['style' => 'text-align:left'],
                    'submitOnEnter' => false,
                    'options' => [
                        'class' => 'form-control',
                        'rows' => 5,
                        'style' => 'width:500px',
                        'placeholder' => 'Enter notes...'
                    ]
                ])); ?>
            </td>
        </tr>
        <tr>
            <th>Shipping label</th>
            <td><?= Editable::widget($gen('shipping_label')); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= Editable::widget($gen('email')); ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?= Editable::widget($gen('phone')); ?></td>
        </tr>
        <tr>
            <th>Brand</th>
            <td><?= Editable::widget($gen('brand')); ?></td>
        </tr>
        <tr>
            <th>Other brand</th>
            <td><?= Editable::widget($gen('other_brand')); ?></td>
        </tr>
        <tr>
            <th>Model</th>
            <td><?= Editable::widget($gen('model')); ?></td>
        </tr>
        <tr>
            <th>Model number</th>
            <td><?= Editable::widget($gen('model_number')); ?></td>
        </tr>
        </tbody>
    </table>

</div>
