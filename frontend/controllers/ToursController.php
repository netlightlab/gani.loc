<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2018
 * Time: 10:31
 */

namespace frontend\controllers;

use frontend\models\Comments;
use yii\web\Controller;
use Yii;
use frontend\models\Tours;
use yii\web\UploadedFile;
use common\models\User;

class ToursController extends Controller
{
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

        $comment = Comments::find()->where(['tour_id' => $id, 'active' => 1])->all();
        $reviews_count = Comments::find()->where(['tour_id' => $id])->count();

        Yii::$app->user->isGuest ? $sign = 0 : $sign = 1;

        $fileName = 'file';
        $uploadPath = 'common/users/'.Yii::$app->user->id;

        if (isset($_FILES[$fileName])) {
            $file = UploadedFile::getInstancesByName($fileName);

            foreach ($file as $item) {
                $item->saveAs($uploadPath . '/' . $item->name);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->message;
            $model->tour_id = $id;
            $model->user_id = Yii::$app->user->id;
            $model->user_photo = $photo;
            $model->fio = $fio;
            $model->active = 1;
            $model->reviews;
            $model->load_photo;
            $model->recommendation = 1;
            $model->save(true);
        };


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
        $url = '';

        if (Yii::$app->request->get('category_id')) {
            $url .= '&category_id=' . Yii::$app->request->get('category_id');
        }

        if (Yii::$app->request->get('city_id')) {
            $url .= '&city_id=' . Yii::$app->request->get('city_id');
        }

        if (Yii::$app->request->get('country_id')) {
            $url .= '&country_id=' . Yii::$app->request->get('country_id');
        }

        $asd = Tours::find()->where(['price' => 40000])->all();

        $time = date('H:i:s');

        return $this->render('search', [
            'url' => $url,
//            'model' => Tours::findTours(Yii::$app->request->get()),
            'model' => $asd,
            'time' => $time,
        ]);
    }

    public function actionUploadCommentsPhoto($id){
        /* DROPZONEJS */



        /* ENDZONENJS */
    }
}