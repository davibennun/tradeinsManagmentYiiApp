<?php

use kartik\editable\Editable;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

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
}



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
                <?= FileInput::widget([
                    'name' => 'Tradein[' . $index . '][image]',
                    'options' => [
                        'multiple' => true,
                        'fileActionSettings' => [
                            'showUpload' => false
                        ],
                    ],
                    'pluginOptions' => [
                        'uploadUrl' => Url::to('?r=tradein/upload'),
                        'url' => Url::to('?r=tradein/upload'),
                        'fileActionSettings' => [
                            'showDrag' => false
                        ],
                        'dropZoneEnabled' => false,
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'layoutTemplates'=> [
                            'btnBrowse' => '<div tabindex="500" class="{css}"{status} style="display:none">{label}</div>'
                        ],
                        'initialPreview' => [
                            $model->image1,
                            $model->image2,
                            $model->image3,
                            $model->image4,
                            $model->image5,
                        ],
                        'initialPreviewAsData' => true,
                        'initialPreviewConfig' => [
                            ['key'=> 'image1', 'caption' => 'Image 1', 'url' => Url::to(['tradein/delete-image', 'id'=>$key])],
                            ['key'=> 'image2', 'caption' => 'Image 2', 'url' => Url::to(['tradein/delete-image', 'id'=>$key])],
                            ['key'=> 'image3', 'caption' => 'Image 3', 'url' => Url::to(['tradein/delete-image', 'id'=>$key])],
                            ['key'=> 'image4', 'caption' => 'Image 4', 'url' => Url::to(['tradein/delete-image', 'id'=>$key])],
                            ['key'=> 'image5', 'caption' => 'Image 5', 'url' => Url::to(['tradein/delete-image', 'id'=>$key])],
                        ],
                        'overwriteInitial' => false,
                        'pluginEvents' => [
                            'filepredelete' => "function(event, key) {return (!confirm('Are you sure you want to delete ?'));}",
                        ]
                    ]
                ]);?>
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

                             <?=
                             Editable::widget($gen('customeritem_if_new',[
                                 'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                 'data' => [0 => 'NO', 1 => 'YES'],
                                 'options' => ['class' => 'form-control', 'prompt' => 'Select status...'],
                                 'displayValueConfig' => [
                                     '0' => '<span class="label label-danger">NO</span>',
                                     '1' => '<span class="label label-success">YES</span>',
                                 ]
                             ]));
                             ?>
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