<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.11.2017
 * Time: 20:21
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Users;
use yii\web\HttpException;


class UsersController extends Controller
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


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(){
        $users = new Users();
        $result = $users->getAllUsers();

        return $this->render("users", ["users" => $result]);
    }

    public function actionEdit($id)
    {
        $users = new Users();
        $userById = $users->editUserById($id);
        $usersRole = $users->getUsersRoleById($id);
        return $this->render("edituser", ["user" => $userById, "role" => $usersRole]);
    }
}