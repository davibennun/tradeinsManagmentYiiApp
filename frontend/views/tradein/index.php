<?php

use common\models\Tradein;
use kartik\dynagrid\DynaGrid;
use kartik\export\ExportMenu;
use yii\base\View;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\grid\GridView as KartikGridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TradeinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tradeins';
$this->params['breadcrumbs'][] = $this->title;

\kartik\detail\DetailViewAsset::register(Yii::$app->getView());
\frontend\assets\LightGalleryAsset::register(Yii::$app->getView());

$columns = array_keys( (new Tradein())->attributeLabels() );

$exportColumns = array_diff($columns, ['status']);
$exportColumns[] = [
    'attribute' => 'status',
    'value' => function ($model, $key, $index, $widget) {
        $labels = Tradein::$statusLabels;
        return $labels[$model->status];
    }
];

$visibleColumns = ['status','first_name','last_name','first_contact','last_contact', 'model_number'];

$hiddenColumns = array_diff($columns, $visibleColumns);

$hiddenColumnsConfig = [];

foreach($hiddenColumns as $hiddenColumn){
    $hiddenColumnsConfig[] = [
        'attribute' => $hiddenColumn,
        'visible' => false,
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
        }
    ];
}

$visibleColumnsConfig = [
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'order' => DynaGrid::ORDER_FIX_LEFT,
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return \kartik\grid\GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model, 'key' => $key, 'index' => $index]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'expandOneOnly' => true,
        'enableRowClick' => true
    ],
    [
        'attribute' => 'status',
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
        },
        'format' => 'raw',
        'width' => '130px',
        'value' => function ($model, $key, $index, $widget) {
            $labels = [
                Tradein::STATUS_ACTIVE => '<span class="label label-primary">'.Tradein::STATUS_ACTIVE_LABEL.'</span>',
                Tradein::STATUS_INACTIVE => '<span class="label label-default">'.Tradein::STATUS_INACTIVE_LABEL.'</span>',
                Tradein::STATUS_CLOSED => '<span class="label label-danger">'.Tradein::STATUS_CLOSED_LABEL.'</span>',
                Tradein::STATUS_SUCCESSFUL => '<span class="label label-success">'.Tradein::STATUS_SUCCESSFUL_LABEL.'</span>',
            ];
            return $labels[$model->status];
        },
        'filterType' => KartikGridView::FILTER_SELECT2,
        'filter' => Tradein::$statusLabels,
        'filterWidgetOptions' => [
            'hideSearch' => true,
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Select status'],
    ],
    [
        'attribute' => 'first_name',
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
        }
    ],
    [
        'attribute' => 'last_name',
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
        }
    ],
    [
        'attribute' => 'first_contact',
        'format' => ['date', 'php:m-d-Y'],
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
        }
    ],
    [
        'attribute' => 'last_contact',
        'format' => ['date', 'php:m-d-Y'],
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
        }
    ],
    [
        'attribute' => 'model_number',
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['id' => 'td-tradein-' . $index . '-' . $column->attribute];
        }
    ],
];

$tableColumnsConfig = array_merge($visibleColumnsConfig, $hiddenColumnsConfig);
?>

<script id="template-download-2" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {%=file.name%}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle">
                {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}

</script>

<div class="tradein-index">

    <h1>
        <?= Html::encode($this->title) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => array_merge($exportColumns),
        'showColumnSelector' => false,
        'exportConfig' => ['HTML' => false, 'TXT' => false, 'PDF' => false, 'Excel5' => false],
        'clearBuffers'=>true,
        'fontAwesome' => true,
        'target' => ExportMenu::TARGET_SELF,
        'dropdownOptions' => [
            'label' => 'Export',
            'class' => 'btn btn-default'
        ]
    ])
    ?>
    </h1>
    <?=
    DynaGrid::widget([
            'gridOptions' => [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'export'=>false,
                'showPageSummary' => false,
                'floatHeader' => false,
                'panel' => [
                    'after' => false
                ],
                'resizableColumns' => true,
                'persistResize' => false,
                'toolbar' => [
                    ['content' => '{dynagrid}'],
                    '{export}',
                ]
            ],
            'options' => ['id'=>'dynagrid-tradein-index-1'],
            'showPersonalize' => true,
//        'allowPageSetting' => false, // Setting allowPageSetting to false causes ordering feature to stop working
            'allowSortSetting' => false,
            'allowFilterSetting' => false,
            'allowThemeSetting' => false,

        'columns' => $tableColumnsConfig,

        ]);
    ?>

</div>


<?php
    $this->registerJs("
        $(function(){
            $('tbody.files').lightGallery({selector:'a'});
        });
    ");

    $this->registerJs('

        $(".lightgallery .kv-file-remove").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            if(! confirm("Are you sure you want to remove this image?"))
                return;
            var that = this;
            $.post($(this).data("url"),{ key : $(this).data("key") }).done(function(){
                $(that).closest(".image-container-link").fadeOut();
            }).fail(function(){
                alert("Error when removing image");
            });
        })
    ');
?>