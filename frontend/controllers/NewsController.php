<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.04.2018
 * Time: 10:30
 */

namespace frontend\controllers;

use Yii;
use common\models\News;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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


    public function actionIndex(){
        $items = News::find()->all();

        $lang = Yii::$app->language;

        foreach($items as $model){
            if($lang === 'en'){
                $model->title_en ? $model->title = $model->title_en : $model->title;
//            $model->description_en ? $model->description = $model->description_en : $model->description;
            }elseif($lang === 'kz'){
                $model->title_kz ? $model->title = $model->title_kz : $model->title;
//            $model->description_kz ? $model->description = $model->description_kz : $model->description;
            }
        }

        return $this->render('index', [
            'items' => $items
        ]);
    }

    public function actionView($id){
        if(is_numeric($id)){
            $model = $this->findModel($id);
        }else{
            $model = News::find()->where(['url' => $id])->one();
        }

        $lang = Yii::$app->language;

        if($lang === 'en'){
            $model->title_en ? $model->title = $model->title_en : $model->title;
            $model->description_en ? $model->description = $model->description_en : $model->description;
        }elseif($lang === 'kz'){
            $model->title_kz ? $model->title = $model->title_kz : $model->title;
            $model->description_kz ? $model->description = $model->description_kz : $model->description;
        }

        return $this->render('view', [
            'item' => $model,
        ]);
    }


    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}