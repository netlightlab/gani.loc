<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08.02.2018
 * Time: 16:31
 */

namespace frontend\controllers;

use common\models\OrderItems;
use common\models\Orders;
use frontend\models\PartnerProfile;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use common\models\User;
use frontend\models\Tours;


class PartnerController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['partner'],
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
    public function actionIndex()
    {
        $usersInfo = User::findOne(['id' => Yii::$app->user->id]);
        $model = new PartnerProfile();
        $tours = $this->getUserTours(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post())) {
            if($model->edit()){
                $this->refresh();
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }
        return $this->render('partner', [
            'UsersInfo' => $usersInfo,
            'model' => $model,
            'tours' => $tours,
        ]);
    }

    public function getUserTours($id) {
        return Tours::find()->where(['user_id' => $id])->select('id, name, price, mini_image')->all();
    }

    public function actionPays(){
        $orders = Orders::find()->where(['user_id' => Yii::$app->user->id])->all();
        //print_r($orders);

        $thisUserTours = Tours::find()->select('id')->where(['user_id' => Yii::$app->user->id])->asArray()->all();

        /**
         * id туров которые принадлежат данному партнеру
         */
        $thisUserToursId = ArrayHelper::map($thisUserTours,'id', 'id');


        $orderItems = OrderItems::find()->with('tickets')->with('tours')->with('orderInfo')->asArray()->all();
        $result = array();
        foreach($orderItems as $orderItem){
            foreach($thisUserToursId as $id){
                if($orderItem['tour_id'] == $id){
                    $result[] = $orderItem;
                }
            }
        }
//        print_r($result);


        return $this->render('pays', [
            'pays' => $result
        ]);
    }
}