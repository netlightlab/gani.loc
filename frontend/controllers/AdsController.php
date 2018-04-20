<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.04.2018
 * Time: 10:16
 */

namespace frontend\controllers;


use yii\web\Controller;
use frontend\models\Ads;
use common\models\User;

class AdsController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(){
        return $this->render('index', [
            'ads' => Ads::find()->where(['active' => 1])->all(),
        ]);
    }

    public function actionView($id){
        $ads = Ads::findOne($id);
        $user = User::find()->where(['id' => $ads->user_id])->one();

        return $this->render('view', [
            'ads' => $ads,
            'user' => $user,
        ]);
    }
}