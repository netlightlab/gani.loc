<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2018
 * Time: 10:31
 */

namespace frontend\controllers;


use backend\models\Pages;
use frontend\models\Comments;
use yii\data\Sort;
use yii\filters\AjaxFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use frontend\models\Tours;
use frontend\models\Search;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\models\User;

class ToursController extends Controller
{
    public function actionIndex(){
        return $this->render('index', [
            'tours' => Tours::find()->where(['status' => 1])->all(),
        ]);
    }

    public function actionView($id){
        $getId = Tours::find()->where(['id' => $id])->select(['user_id'])->one();
        $user = User::find()->where(['id' => $getId->user_id])->select(['id', 'user_photo', 'name_company'])->one();

        $model = new Comments();
        $getUser = User::find()->where(['id' => Yii::$app->user->id])->select(['user_photo', 'user_name', 'surname'])->asArray()->one();
        $fio = $getUser['user_name'].' '.$getUser['surname'];
        $photo = $getUser['user_photo'];

        if ($model->load(Yii::$app->request->post())) {
            $model->message;
            $model->tour_id = $id;
            $model->user_id = Yii::$app->user->id;
            $model->user_photo = $photo;
            $model->fio = $fio;
            $model->active = 1;
            $model->reviews;
            $model->recommendation = 1;
            $model->save(true);
        };

        $comment = Comments::find()->where(['tour_id' => $id])->all();
        $reviews_count = Comments::find()->where(['tour_id' => $id])->count();

        Yii::$app->user->isGuest ? $sign = 0 : $sign = 1;

        return $this->render('view', [
            'tour' => Tours::findOne($id),
            'user' => $user,
            'model' => $model,
            'comments' => $comment,
            'isauthorize' => $sign,
            'reviews_count' => $reviews_count,
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