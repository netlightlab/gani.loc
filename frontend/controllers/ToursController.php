<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2018
 * Time: 10:31
 */

namespace frontend\controllers;


use backend\models\Pages;
use yii\web\Controller;
use frontend\models\Tours;

class ToursController extends Controller
{
    public function actionIndex(){
        return $this->render('index',
            [
                'tours' => Tours::find()->where(['status' => 1])->all(),
            ]);
    }

    public function actionView($id){
        return $this->render('view', [
            'tour' => Tours::findOne($id),
        ]);
    }
}