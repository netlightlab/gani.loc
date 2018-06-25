<?php

namespace backend\controllers;

use common\models\Banners;
use Yii;
use common\models\Cities;
use common\models\News;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * BannersController implements the CRUD actions for News model.
 */
class BannersController extends Controller
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


    /**
     * Lists all Banners models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Banners::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banners model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banners();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'banner');

            $model->banner = $image;
            $model->save(false);

            $url = str_replace('\\', '/', Yii::getAlias('@frontend'));
            FileHelper::createDirectory($url.'/web/common/banners/' . $model->id);
            $dir = Yii::getAlias($url.'/web/common/banners/' . $model->id);

            if($model->banner)
                $model->banner->saveAs($dir . '/' . $model->banner->name);

            return $this->redirect(['/banners/index']);
        }

        if (Yii::$app->request->isAjax) {
            $banner = new Banners();
            $arr = $banner->getPositionList((int)Yii::$app->request->post('country_id'));

            echo json_encode($arr);
            return false;
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Banners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public $save_image_update;
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
   
        $this->save_image_update = $model->banner;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $url = str_replace('\\', '/', Yii::getAlias('@frontend'));
            FileHelper::createDirectory($url.'/web/common/banners/' . $id);
            $dir = Yii::getAlias($url.'/web/common/banners/' . $id);

            $image = UploadedFile::getInstance($model, 'banner');
            if($image->name !== NULL)
            {
                $model->banner = $image;
                $model->banner->saveAs($dir . '/' . $model->banner->name);
            }
            else
            {
                $model->banner = $this->save_image_update;
            }

            $model->save(false);

            Yii::$app->session->setFlash('success', 'Обновлено');
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banners::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
