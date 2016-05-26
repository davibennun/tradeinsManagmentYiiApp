<?php

use kartik\editable\Editable;
use yii\helpers\Html;
use yii\helpers\Json;

$beforeInput = function($attr) use ($model, $index, $key){
    $strKey = !is_string($key) && !is_numeric($key) ? (is_array($key) ? Json::encode($key) : (string)$key) : $key;
    return $params = Html::hiddenInput('editableIndex', $index) . Html::hiddenInput('editableKey', $strKey) .
        Html::hiddenInput('editableAttribute', $attr);
};

$gen = function ($attr, $opt = []) use ($model, $index, $key, $beforeInput) {

    return array_merge([
        'id' => 'tradein-' . $index . '-' . $attr,
        'model' => $model,
        'name' => 'Tradein[' . $index . '][' . $attr . ']',
        'value' => $model->$attr,
        'asPopover' => false,
        'header' => 'Name',
        'size' => 'md',
        'options' => ['class' => 'form-control'],
        'beforeInput'=> $beforeInput($attr),
    ], $opt);
};

?>
<h3>
    Tradein # <?= $model->id ?>
    <small><?= $model->creation_time; ?></small>
</h3>
<table id="w7" class="table table-hover table-bordered detail-view" data-krajee-kvdetailview="kvDetailView_6af70826">
    <tbody>
    <tr class="info">
        <th colspan="2">Customer Information</th>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">First Name</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('first_name')); ?></div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Last Name</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('last_name')); ?></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Email</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('email')); ?></div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Phone</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('phone')); ?></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">First Contact</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget(
                                [
                                    'beforeInput' => $beforeInput('first_contact'),
                                    'model' => $model,
                                    'attribute' => 'first_contact',
                                    'header' => 'First contact',
                                    'asPopover' => true,
                                    'size' => 'md',
                                    'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
                                    'widgetClass' => 'kartik\datecontrol\DateControl',
                                    'options' => [
                                        'id' => 'tradein-' . $index . '-first_contact',
                                        'name' => 'Tradein[' . $index . '][first_contact]',
                                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                        'displayFormat' => 'php:m-d-Y',
                                        'saveFormat' => 'php:Y-m-d',
                                        'options' => [
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'value' => 'test',
                                                'format'=>'php:m-d-Y'
                                            ],
                                        ]
                                    ]
                                ]
                            ); ?>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Last Contact</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget(
                                [
                                    'beforeInput' => $beforeInput('last_contact'),
                                    'model' => $model,
                                    'attribute' => 'last_contact',
                                    'header' => 'Last contact',
                                    'asPopover' => true,
                                    'format' => 'php:m-d-Y',
                                    'size' => 'md',
                                    'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
                                    'widgetClass' => 'kartik\datecontrol\DateControl',
                                    'options' => [
                                        'id' => 'tradein-' . $index . '-last_contact',
                                        'name' => 'Tradein[' . $index . '][last_contact]',
                                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                        'displayFormat' => 'php:m-d-Y',
                                        'saveFormat' => 'php:Y-m-d',
                                        'options' => [
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                            ],
                                        ]
                                    ]
                                ]
                            ); ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <th style="width: 20%; text-align: right; vertical-align: middle;">Contact Notes</th>
        <td>
            <div class="kv-attribute"><span class="text-justify"><em>
                        <?= Editable::widget($gen('contact_notes')); ?>
                    </em></span></div>
        </td>
    </tr>
    <tr>
        <th style="width: 20%; text-align: right; vertical-align: middle;">Internal Notes</th>
        <td>
            <div class="kv-attribute"><span class="text-justify"><em>
                        <?= Editable::widget($gen('internal_notes')); ?>
                    </em></span></div>
        </td>
    </tr>
    <tr class="info">
        <th colspan="2">Watch Info</th>
    </tr>
    <tr>
        <th style="width: 20%; text-align: right; vertical-align: middle;">Images</th>
        <td>
            <div class="kv-attribute">
                <img style="border: 1px solid grey; padding 5px;" src="http://placehold.it/140x100?text=not+set" alt=""/>
                <img style="border: 1px solid grey; padding 5px;" src="http://placehold.it/140x100?text=not+set" alt=""/>
                <img style="border: 1px solid grey; padding 5px;" src="http://placehold.it/140x100?text=not+set" alt=""/>
                <img style="border: 1px solid grey; padding 5px;" src="http://placehold.it/140x100?text=not+set" alt=""/>
                <img style="border: 1px solid grey; padding 5px;" src="http://placehold.it/140x100?text=not+set" alt=""/>
            </div>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Brand</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('brand')); ?></div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Other Brand</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('other_brand')); ?></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Model</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('model')); ?></div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Model Number</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('model_number')); ?></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Condition</th>
                    <td>
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('condition')); ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Item is new</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <span class="label <?= $model->customeritem_if_new ? 'sucess' : 'danger' ?>
                             label-danger"><?= $model->customeritem_if_new ? 'YES' : 'NO' ?></span>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Item retail value</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('customeritem_retail_value')); ?></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Item vendor offer</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('customeritem_vendor_offer')); ?>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Item jomashop offer</th>
                    <td style="width:30%">
                        <div class="kv-attribute"><?= Editable::widget($gen('customeritem_jomashop_offer')); ?></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Purchase date</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget(
                                [
                                    'beforeInput' => $beforeInput('purchase_date'),
                                    'model' => $model,
                                    'attribute' => 'purchase_date',
                                    'header' => 'Purchase Date',
                                    'asPopover' => true,
                                    'format' => 'php:m-d-Y',
                                    'size' => 'md',
                                    'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
                                    'widgetClass' => 'kartik\datecontrol\DateControl',
                                    'options' => [
                                        'id' => 'tradein-' . $index . '-purchase_date',
                                        'name' => 'Tradein[' . $index . '][purchase_date]',
                                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                        'displayFormat' => 'php:m-d-Y',
                                        'saveFormat' => 'php:Y-m-d',
                                        'options' => [
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                            ],
                                        ]
                                    ]
                                ]
                            ); ?>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Purchased from</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget(
                                [
                                    'beforeInput' => $beforeInput('purchased_from'),
                                    'model' => $model,
                                    'attribute' => 'purchased_from',
                                    'header' => 'Purchased from',
                                    'asPopover' => true,
                                    'format' => 'php:m-d-Y',
                                    'size' => 'md',
                                    'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
                                    'widgetClass' => 'kartik\datecontrol\DateControl',
                                    'options' => [
                                        'id' => 'tradein-' . $index . '-purchased_from',
                                        'name' => 'Tradein[' . $index . '][purchased_from]',
                                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                        'displayFormat' => 'php:m-d-Y',
                                        'saveFormat' => 'php:Y-m-d',
                                        'options' => [
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                            ],
                                        ]
                                    ]
                                ]
                            ); ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Shipping label</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('shipping_label')); ?>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Box papers</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('box_papers')); ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">New item customer wants</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('info_newitem_customer_wants')); ?>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">New item cost</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('newitem_cost')); ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="kv-child-table-row">
        <td class="kv-child-table-cell" colspan="2">
            <table class="kv-child-table">
                <tbody>
                <tr>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">New item jomashop current price
                    </th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                                <?= Editable::widget($gen('newitem_jomashop_currentprice')); ?>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Out of pocket price</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('outofpocket_price')); ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>