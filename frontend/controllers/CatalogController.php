<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.04.2018
 * Time: 10:30
 */

namespace frontend\controllers;

use Yii;
use common\models\Catalog;
use frontend\models\Tours;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
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
        $items = Catalog::find()->all();

        $lang = Yii::$app->language;

        foreach($items as $item){
            if($lang === 'kz'){
                $item->name_kz ? $item->name = $item->name_kz : $item->name;
            }elseif($lang === 'en'){
                $item->name_en ? $item->name = $item->name_en : $item->name;
            }
        }

        return $this->render('index', [
            'items' => $items
        ]);
    }

//    public function actionView($alias){
    public function actionView($id){
        if(is_numeric($id)){
            $item = $this->findModel($id);
        }else{
            $item = Catalog::find()->where(['url' => $id])->one();
        }

        $lang = Yii::$app->language;

        if($lang === 'kz'){
            $item->name_kz ? $item->name = $item->name_kz : $item->name;
            $item->text_kz ? $item->text = $item->text_kz : $item->text;
        }elseif($lang === 'en'){
            $item->name_en ? $item->name = $item->name_en : $item->name;
            $item->text_en ? $item->text = $item->text_en : $item->text;
        }

        $recomendations = Tours::find()->where(['category_id' => $item->recommended])->limit(4)->all();

        return $this->render('view', [
            'item' => $item,
            'recomendations' => $recomendations
        ]);
    }


    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catalog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}