<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09.02.2018
 * Time: 15:53
 */

namespace frontend\controllers;

use frontend\models\PartnerProfile;
use frontend\models\Tours;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;


class ToursController extends Controller
{
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new Tours();
        if ($model->load(Yii::$app->request->post())) {
            if($model->addTour()){
                $this->refresh();
                Yii::$app->session->setFlash("success", "Тур успешно добавлен");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }
        return $this->render('add', [
            'model' => $model,
        ]);
    }
}