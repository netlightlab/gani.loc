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
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\filters\AjaxFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use frontend\models\Tours;
use frontend\models\Search;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\filters\AccessControl;

class ToursController extends Controller
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

        $search = new Search();

        $m = new Tours;

//        $model = Tours::find()->all();

//        $b = $search->search(Yii::$app->request->get());

//        $a = $b;

//        $dataProvider = new ActiveDataProvider([
//            'query' => Tours::find()->where(Yii::$app->request->get()),
//        ]);

//        print_r(Yii::$app->request->get());

//        $activeDataProvider = $search->search(Yii::$app->request->queryParams);

//        $activeDataProvider = $search->search([$search->formName() => Yii::$app->request->queryParams]);
        if(Yii::$app->request->isPjax){
            //print_r(2323);
            $activeDataProvider = $search->search([$search->formName() => Yii::$app->request->post()['Tours']]);
            return $this->render('search', [
                'tours' => $activeDataProvider->getModels(),
                'search_form' => $m,
            ]);
        } else {
            $activeDataProvider = $search->search([$search->formName() => Yii::$app->request->post()['Tours']]);
            return $this->render('search', [
                'tours' => $activeDataProvider->getModels(),
                'search_form' => $m,
            ]);
        }
    }
}