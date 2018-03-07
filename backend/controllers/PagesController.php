<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.2017
 * Time: 13:17
 */

namespace backend\controllers;


use backend\models\Pages;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PagesController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
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

    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Pages::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $file = UploadedFile::getInstance($model, 'background');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            //FileHelper::createDirectory('uploads/pages/' . $id . '/');
            $url = str_replace('\\', '/', Yii::getAlias('@frontend'));
            FileHelper::createDirectory($url.'/web/common/pages/' . $id . '/');
            //$folder = Yii::getAlias('uploads/pages/' . $id);
            $folder = Yii::getAlias($url.'/web/common/pages/' . $id);

            if($file){
                $model->background = $file;
                $model->background->saveAs($folder .'/'. $model->background->baseName . '.' . $model->background->extension);
            }

            $model->save(false);

            Yii::$app->session->setFlash("success", "Сохранено");
            return $this->redirect(['update', 'id' => $model->id]);
            //return $this->redirect(['index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Pages();

        $file = UploadedFile::getInstance($model, 'background');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->background = $file;

            $model->save(false);

            //FileHelper::createDirectory('uploads/pages/' . $model->id . '/');
            $url = str_replace('\\', '/', Yii::getAlias('@frontend'));
            FileHelper::createDirectory($url.'/web/common/pages/' . $model->id . '/');
            //$folder = Yii::getAlias('uploads/pages/' . $model->id);
            $folder = Yii::getAlias($url.'/web/common/pages/' . $model->id);

            if($file){
                $model->background = $file;
                $model->background->saveAs($folder .'/'. $model->background->baseName . '.' . $model->background->extension);
            }

            Yii::$app->session->setFlash("success", "Страница создана");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует');
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
}