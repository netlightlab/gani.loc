<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.11.2017
 * Time: 20:21
 */

namespace backend\controllers;

use backend\models\EditUser;
use Codeception\Module\Db;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rbac\DbManager;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Users;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;


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
        $role = new DbManager();

        $ro = $role->getUserIdsByRole('user');

        $dataProvider = new ActiveDataProvider([
            'query' => Users::find()->where(['!=', 'role', 'admin']),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'asd' => $ro
        ]);
    }

    public function actionUpdate($id)
    {
        /*$model = new EditUser();
        if ($model->load(Yii::$app->request->post())) {
            if($model->edit()){
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }

        return $this->render("edituser", [
            "model" => $model,
        ]);*/
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash("success", "Сохранено");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $auth = new DbManager();
        $auth->deleteUserAuth($id);

        $this->findModel($id)->delete();

        Yii::$app->session->setFlash("success", "Пользователь был удален");
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует');
    }

}