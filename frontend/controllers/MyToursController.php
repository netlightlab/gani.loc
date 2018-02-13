<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09.02.2018
 * Time: 15:53
 */

namespace frontend\controllers;

use frontend\models\Tours;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;


class MyToursController extends Controller
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
    public function actionAdd()
    {
        $model = new Tours();
        $image1 = UploadedFile::getInstance($model, 'back_image');
        $image2 = UploadedFile::getInstance($model, 'mini_image');
        $image3 = UploadedFile::getInstance($model, 'gallery');
        if ($model->load(Yii::$app->request->post())) {
            if($model->addTour()){
                $this->refresh();
                FileHelper::createDirectory('common/tour_img/' .$model->id. '/');
                $dir = Yii::getAlias('common/tour_img/' .$model->id. '/');
                Yii::$app->session->setFlash("success", "Тур успешно добавлен");
                $image1->saveAs($dir . $image1->name);
                $image2->saveAs($dir . $image2->name);
                $image3->saveAs($dir . $image3->name);
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            };
        };

        return $this->render('add', [
            'model' => $model,
        ]);
    }
}