<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.03.2018
 * Time: 9:35
 */

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Tours;
use Yii;
use frontend\models\SignupForm;
use frontend\models\LoginForm;
use common\models\Payment;

class OrdersController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex(){
        //$tourId = Yii::$app->request->post('tour_id');
        //Yii::$app->session->set('tour_order', $tourId);
        //print_r(Yii::$app->session->get('tour_order'));
        /*if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('success','Для покупки необходимо войти или зарегистрироваться');
            return Yii::$app->getResponse()->redirect('/payment/auth');
        }*/
        $orders = Yii::$app->session->get('tour_id');
        return $this->render('index', [
            'orders' => $orders
        ]);
    }

    public function actionAuth(){
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/payment/index');
        } else {
            return $this->render('auth', [
                'model' => $model
            ]);
        }
    }
}