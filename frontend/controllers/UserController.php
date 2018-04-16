<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.11.2017
 * Time: 11:02
 */

namespace frontend\controllers;

use common\models\Cities;
use common\models\Tickets;
use frontend\models\UserProfile;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\UploadedFile;
use common\models\User;
use yii\validators\CompareValidator;
use common\models\Orders;
use common\models\OrderItems;


class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
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
        $model = new UserProfile();

        $orders = Orders::find()->where(['user_id' => Yii::$app->user->id])->all();
        //print_r($orders);
        $result = array();
        foreach($orders as $order){
            $result[$order->id] = array(
                'order_info' => Orders::find()->where(['id' => $order->id])->asArray()->one(),
                //'tickets' => Tickets::find()->where(['order_num' => $order->id])->indexBy('tour_id')->asArray()->all(),
                'tours_info' => Orders::findOne($order->id)
                    ->getItems()
                    ->select(['id','qty','sum','tour_id', 'order_id'])
                    ->indexBy('id')
                    ->asArray()
                    ->all()
            );
        }
//        print_r($result);
        //print_r($a);
        /*$o = array(
            [order_id] => array(
                [tour_id] => [
                    [id] => id,
                    [qty] => qty
                ]
            )
        );*/
        //$orderItems = OrderItems::find()->where(['user_id' => Yii::$app->user->id])->all();

        if ($model->load(Yii::$app->request->post())) {
            if($model->edit()){
                $this->refresh();
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }
        return $this->render('user', [
            'UsersInfo' => $usersInfo,
            'model' => $model,
            'orders' => $result,
            //'orderItems' => $orderItems
        ]);
    }

    public function actionEditprofile() {
        $model = new UserProfile();

        if ($model->load(Yii::$app->request->post())) {
            if($model->edit()){
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }

        /*if($model->getUserInfo()){
            $model = $model->getUserInfo();
        }*/

        return $this->render('editprofile', [
            'model' => $model,
        ]);
    }

    public function actionTicket($id){
        $model = Tickets::findOne((int)$id);
        return $this->render('ticket', [
            'item' => $model
        ]);
    }
}