<?php

namespace frontend\controllers;

use HttpException;
use Yii;
use common\models\Tradein;
use common\models\TradeinSearch;
use frontend\controllers\behaviours\EditableBehaviour;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TradeinController implements the CRUD actions for Tradein model.
 */
class TradeinController extends Controller
{
    /**
     * @inheritdoc
     */
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
                'modelName' => Tradein::class
            ]
        ];
    }

    /**
     * Lists all Tradein models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TradeinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tradein model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tradein model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tradein();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tradein model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tradein model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionImageUpload()
    {


            $imageFile = UploadedFile::getInstanceByName('Tradein[image1]');
            $directory = \Yii::getAlias('@frontend/web/uploads');
            if (!is_dir($directory)) {
                mkdir($directory);
            }
            if ($imageFile) {
                $fileName = uniqid() . '.' . $imageFile->extension;
                $filePath = \Yii::getAlias('@frontend/web/uploads') . '/'. $fileName;
                $relativePath = '/uploads/'.$fileName;

                if ($imageFile->saveAs($filePath)) {

                    $tradein = $this->findModel(Yii::$app->request->get('id'));

                    if(! $imageColumn = $tradein->getNextAvailableImageSlot())
                        throw new HttpException(400, 'Maximum number of images exceeded.');

                    $tradein->$imageColumn = URL::to($relativePath,true);
                    if($tradein->save())
                        return Json::encode([
                            'files' => [[
                                'name' => 'Image #' . substr($imageColumn, -1),
                                'key' => $imageColumn,
                                'size' => $imageFile->size,
                                "url" => $relativePath,
                                "thumbnailUrl" => $relativePath,
                                "deleteUrl" => Url::to(['tradein/delete-image', 'id' => $tradein->id, 'key' => $imageColumn]),
                                "deleteType" => "DELETE"
                            ]]
                        ]);
                }
            }
            return '';
    }

    public function actionDeleteImage()
    {
        if (Yii::$app->request->isDelete) {
            if(! ($imageField = Yii::$app->request->get('key'))){
                throw new BadRequestHttpException('Your requeset should contain a "key" attribute, ie. the image field you are trying to remove');
            }

            $model = $this->findModel(Yii::$app->request->get('id'));

            $pathChunks = explode('/', $model->$imageField);

            unlink(\Yii::getAlias('@frontend/web/uploads') . '/' . end($pathChunks));

            $model->$imageField = null;

            if($model->save()){
                echo '{}';
            }else{
                echo json_encode(['error'=>$model->errors]);
            }

        }
    }

    /**
     * Finds the Tradein model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tradein the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tradein::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
