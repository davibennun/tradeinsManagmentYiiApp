<?php

use common\widgets\Alert;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= Alert::widget() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email',
            [
                'class' => ActionColumn::class,
                'buttons' => [
                    'update'=> function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-asterisk"></span>', $url, ['title'=>'Change password']);
                    }
                ],
                //Hide delete button when the row is equals to the logged user
                'visibleButtons' => ['view'=>false,'delete'=>function($model){
                    return Yii::$app->user->id != $model->id;
                }],
                'contentOptions' => ['style' => 'width:50px;']
            ],
        ],
    ]); ?>
</div>
