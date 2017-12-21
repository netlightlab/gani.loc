<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.2017
 * Time: 13:17
 */

namespace backend\controllers;


use backend\models\Pages;
use yii\web\Controller;
use Yii;

class PagesController extends Controller
{
    public function actionIndex(){
        $model = new Pages();
        $data = $model->getPages();
        return $this->render('index', [
            "links" => $data,
        ]);
    }

    public function actionCreate(){
        $model = new Pages();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save(false)){
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionEdit(){
        $model = new Pages();
        $model = $model->getPage();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save(false)){
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }
        return $this->render('edit',[
            "model" => $model
        ]);
    }
}