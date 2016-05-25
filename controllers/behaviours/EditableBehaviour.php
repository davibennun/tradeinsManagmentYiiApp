<?php


namespace app\controllers\behaviours;


use Yii;
use yii\base\ActionFilter;

class EditableBehaviour extends ActionFilter{

    public $modelName;

    public $model;

    public $validation;

    public function beforeAction($action)
    {
        $request= Yii::$app->request;
        if ($request->post('hasEditable')) {
            $this->model = (new $this->modelName)->findOne($request->post('editableKey') ? $request->post('editableKey') : $request->get('id'));
            $singleModelName = (new \ReflectionClass($this->modelName))->getShortName();
            $posted = current($request->post($singleModelName));
            $post= is_array($posted) ? [$singleModelName => $posted] : [ $singleModelName => $request->post($singleModelName) ];

            if ($this->model->load($post)) {
                $out = ['output' => '', 'message' => ''];

                if (!$this->model->validate()) {
//                    var_dump($this->model->errors);
                    $message = array_values($this->model->errors)[0][0];
                    $out['message'] = $message;
                }else{
                    $this->model->save();
                }

                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                Yii::$app->response->content = json_encode($out);
            }

            return false;

        }
        return parent::beforeAction($action);
    }
}