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
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}