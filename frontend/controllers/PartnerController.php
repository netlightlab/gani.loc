<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08.02.2018
 * Time: 16:31
 */

namespace frontend\controllers;

use frontend\models\PartnerProfile;
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
}