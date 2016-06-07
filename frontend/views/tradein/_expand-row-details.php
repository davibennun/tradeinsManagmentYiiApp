<?php

use common\models\Tradein;
use kartik\editable\Editable;
use kartik\file\FileInputAsset;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

FileInputAsset::register($this);

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
        'header' => $model->getAttributeLabel($attr),
        'size' => 'md',
        'options' => ['class' => 'form-control'],
        'beforeInput'=> $beforeInput($attr),
        'pluginEvents'=>[
            'editableSubmit' => "function(event, val, form) {
                var sel = '#td-'+$('input.kv-editable-input',form).attr('id');
                $(sel).html(val);
            }",
        ]
    ], $opt);
};

// Create a dummy grid
$grid = Yii::createObject(['class' => 'kartik\grid\GridView', 'export' => false, 'dataProvider' => Yii::createObject('yii\data\ArrayDataProvider')]);

$genDate = function($attr, $opt=[]) use ($grid, $model, $index, $key, $beforeInput) {
    return Yii::createObject(array_merge([
        'grid' => $grid,
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => $attr,
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'format' => ['date', 'php:m-d-Y'],
        'width' => '20%',
        'xlFormat' => "mmm\\-dd\\, \\-yyyy",
        'headerOptions' => ['class' => 'kv-sticky-column'],
        'contentOptions' => ['class' => 'kv-sticky-column'],
        'editableOptions' => [
            'header' => $model->getAttributeLabel($attr),
            'size' => 'md',
            'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
            'widgetClass' => 'kartik\datecontrol\DateControl',
            'pluginEvents' => [
                'editableSubmit' => "function(event, val, form) {
                    var sel = '#td-'+$('input.kv-editable-input',form).attr('id').replace('-disp','');
                    $(sel).html(val);
                    console.log(sel, val);
                }"
            ],
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'displayFormat' => 'php:m-d-Y',
                'saveFormat' => 'php:Y-m-d',
                'options' => [
                    'name' => 'Tradein[' . $index . ']['.$attr.']',
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]
        ],
    ],$opt))->renderDataCellContent($model, $key, $index);
};

$statusValueConfig = [
    '10' => '<span class="label label-primary">Active</span>',
    '20' => '<span class="label label-default">Inactive</span>',
    '30' => '<span class="label label-danger">Closed</span>',
    '40' => '<span class="label label-success">Successful</span>',
];

$genImage = function($attr) use ($model, $key, $index){

    $label = $model->getAttributeLabel($attr);
    return empty($model->$attr) ? '' : '<a href="'. $model->$attr .'" class="image-container-link">
                <div class="file-preview-frame file-preview-initial">
                    <div class="kv-file-content">
                        <img src="'. $model->$attr .'" class="kv-preview-data file-preview-image" title="'.$label.'" alt="'.$label.'"  style="width:auto;height:160px;">
                    </div>
                    <div class="file-thumbnail-footer">
                        <div class="file-footer-caption" title="'.$label.'">' . $label . '</div>
                        <div class="file-actions">
                            <div class="file-footer-buttons">
                                <button type="button" class="kv-file-remove btn btn-xs btn-default"
                                        title="Remove file"
                                        data-url="/index.php?r=tradein%2Fdelete-image&amp;id='.$model->id.'"
                                        data-key="'.$attr.'"><i
                                        class="glyphicon glyphicon-trash text-danger"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </a>';
}

?>

<h3>
    <?=
    Editable::widget($gen('status', [
        'inputType' => Editable::INPUT_DROPDOWN_LIST,
        'asPopover' => true,
        'data' => [Tradein::STATUS_ACTIVE => 'Active', 20 => 'Inactive', 30 => 'Closed', 40 => 'Sucessful'],
        'options' => ['class' => 'form-control', 'prompt' => 'Select status...'],
        'displayValueConfig' => $statusValueConfig,
        'pluginEvents' => [
            'editableSubmit' => "function(event, val, form) {
                    var id = '#td-'+$('select',form).attr('id');
                    var valueConfig = ".json_encode($statusValueConfig).";
                    $(id).html(valueConfig[val]);
                }"
        ],
    ]));
    ?>
    Tradein # <?= $model->id ?>
    <small><?= \Datetime::createFromFormat('Y-m-d H:i:s', $model->creation_time)->format('m-d-Y h:i A'); ?></small>
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
                            <?= $genDate('first_contact'); ?>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Last Contact</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= $genDate('last_contact'); ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <th style="width: 20%; text-align: right; vertical-align: middle;">Contact Notes</th>
        <td style="width: 80%;">
            <?= Editable::widget($gen('contact_notes',[
                    'inputType'=> Editable::INPUT_TEXTAREA,
                    'submitOnEnter' => false,
                    'editableValueOptions' => ['style' => 'text-align:left'],
                    'displayValue' => nl2br($model->contact_notes),
                    'options' => ['class' => 'form-control', 'rows' => 5, 'style' => 'width:400px', 'placeholder' => 'Enter notes...']
            ])); ?>
        </td>
    </tr>
    <tr>
        <th style="width: 20%; text-align: right; vertical-align: middle;">Internal Notes</th>
        <td style="width: 80%;">
            <?= Editable::widget($gen('internal_notes', [
                'inputType' => Editable::INPUT_TEXTAREA,
                'editableValueOptions'=> ['style'=>'text-align:left'],
                'displayValue'=> nl2br($model->internal_notes),
                'submitOnEnter' => false,
                'options' => ['class' => 'form-control', 'rows' => 5, 'style' => 'width:400px;', 'placeholder' => 'Enter notes...']
            ])); ?>
        </td>
    </tr>
    <tr class="info">
        <th colspan="2">Watch Info</th>
    </tr>
    <tr>
        <th style="width: 20%; text-align: right; vertical-align: middle;">Images</th>
        <td>
            <div class="kv-attribute">

                <div class="file-preview ">
                    <div class="file-drop-disabled">
                        <div class="file-preview-thumbnails">
                            <div class="file-initial-thumbs lightgallery">

                                <?= $genImage('image1') ?>
                                <?= $genImage('image2') ?>
                                <?= $genImage('image3') ?>
                                <?= $genImage('image4') ?>
                                <?= $genImage('image5') ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>



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
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Item worth if it was new</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('customeritem_if_new')); ?>
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
                            <?= $genDate('purchase_date'); ?>
                        </div>
                    </td>
                    <th style="width: 20%; text-align: right; vertical-align: middle;">Purchased from</th>
                    <td style="width:30%">
                        <div class="kv-attribute">
                            <?= Editable::widget($gen('purchased_from')); ?>
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