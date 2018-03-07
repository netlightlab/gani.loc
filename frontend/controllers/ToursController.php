<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2018
 * Time: 10:31
 */

namespace frontend\controllers;


use backend\models\Pages;
use yii\data\Sort;
use yii\web\Controller;
use Yii;
use frontend\models\Tours;
use frontend\models\Search;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

class ToursController extends Controller
{
    public function actionIndex(){
        return $this->render('index', [
            'tours' => Tours::find()->where(['status' => 1])->all(),
        ]);
    }

    public function actionView($id){
        return $this->render('view', [
            'tour' => Tours::findOne($id),
        ]);
    }

    public function actionSearch(){

        $searchModel = new Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $getParams = Yii::$app->request->get();


        $sort = new Sort([
            'attributes' => [
                'price' => [
                    'asc' => ['price' => SORT_ASC],
                    'desc' => ['price' => SORT_DESC],
                    'label' => 'Name',
                ],
            ],
        ]);

        $tour = Tours::find();

        $pages = new Pagination(['totalCount' => $tour->count(), 'pageSize' => 3]);
        $pages->pageSizeParam = false;


        $models = $tour->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('search', [
            'searchModel' => $searchModel,
            'pages' => $pages,
            'model' => $models,
            'dataProvider' => $dataProvider,
        ]);

//
//        $sort = new Sort([
//            'attributes' => [
//                'price' => [
//                    'asc' => ['price' => SORT_ASC],
//                    'desc' => ['price' => SORT_DESC],
//                    'label' => 'Name',
//                ],
//            ],
//        ]);
//
//        $getParams = Yii::$app->request->get();


        return $this->render('search', [
            'sort' => $sort,
            'tours' => Tours::findTours($getParams, $sort->orders),
        ]);

//        return $this->render('search', [
//            'tours' => Tours::findTours(Yii::$app->request->get()),
//        ]);
    }
}