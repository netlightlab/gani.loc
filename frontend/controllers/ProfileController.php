<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.11.2017
 * Time: 11:02
 */

namespace frontend\controllers;

use frontend\models\EditProfile;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use frontend\models\Profile;
use yii\web\UploadedFile;
use yii\web\User;


class ProfileController extends Controller
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
        $usersLogin = Profile::getUserLogin();
        $usersInfo = Profile::getUserInfo();
        return $this->render('profile', [
            'UsersInfo' => $usersInfo,
            'UsersLogin' => $usersLogin,
        ]);
    }

    public function actionEditprofile() {
        $model = new EditProfile();

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
}