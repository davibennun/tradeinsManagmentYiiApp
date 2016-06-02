<?php


namespace frontend\controllers;

use common\models\User;
use frontend\controllers\behaviours\EditableBehaviour;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class UserController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'editable' => [
                'class' => EditableBehaviour::class,
                'modelName' => User::class
            ]
        ];
    }

    public function actionIndex()
    {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'searchModel' => new User(),
            'dataProvider' => $dataProvider,
        ]);
    }

}