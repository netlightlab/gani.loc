<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.11.2017
 * Time: 11:02
 */

namespace frontend\controllers;

use common\models\Tickets;
use frontend\models\Ads;
use frontend\models\Comments;
use frontend\models\Tours;
use frontend\models\UserProfile;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use common\models\User;
use common\models\Orders;
use yii\web\NotFoundHttpException;
use yii\helpers\FileHelper;
use yii\web\Response;
use yii\web\UploadedFile;
use common\models\Cities;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
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
    public function actionIndex()
    {
        $usersInfo = User::findOne(['id' => Yii::$app->user->id]);
        $model = new UserProfile();

        $orders = Orders::find()->where(['user_id' => Yii::$app->user->id])->all();
        //print_r($orders);
        $result = array();
        foreach($orders as $order){
            $result[$order->id] = array(
                'order_info' => Orders::find()->where(['id' => $order->id])->asArray()->one(),
                //'tickets' => Tickets::find()->where(['order_num' => $order->id])->indexBy('tour_id')->asArray()->all(),
                'tours_info' => Orders::findOne($order->id)
                    ->getItems()
                    ->select(['id','qty','sum','tour_id', 'order_id'])
                    ->indexBy('id')
                    ->asArray()
                    ->all()
            );
        }
//        print_r($result);
        //print_r($a);
        /*$o = array(
            [order_id] => array(
                [tour_id] => [
                    [id] => id,
                    [qty] => qty
                ]
            )
        );*/
        //$orderItems = OrderItems::find()->where(['user_id' => Yii::$app->user->id])->all();

        if ($model->load(Yii::$app->request->post())) {
            if($model->edit()){
                $this->refresh();
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if($model->edit()){
                $this->refresh();
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }

        if (Yii::$app->request->isAjax) {
            $cities = new Cities();
            $arr = $cities->getCitiesList((int)Yii::$app->request->post('country_id'));
            echo json_encode($arr);
            return false;
        }

        return $this->render('user', [
            'UsersInfo' => $usersInfo,
            'model' => $model,
            'orders' => $result,
            'ads' => Ads::find()->where(['user_id' => Yii::$app->user->id])->all(),
        ]);
    }

    public function actionEditprofile() {
        $model = new UserProfile();

        if ($model->load(Yii::$app->request->post())) {
            if($model->edit()){
                Yii::$app->session->setFlash("success", "Сохранено");
            }else{
                Yii::$app->session->setFlash("error", "Ошибка");
            }
        }

        return $this->render('editprofile', [
            'model' => $model,
        ]);
    }

    public function actionTicket($id){
        $model = Tickets::findOne((int)$id);
        $tour = Tours::findOne((int)$model->tour_id);
        return $this->render('ticket', [
            'item' => $model,
            'tour' => $tour,
        ]);
    }

    /**
     * Creates a new Ads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdsCreate()
    {
        $model = new Ads();
        $model->user_id = Yii::$app->user->id;

        $fileName = 'file';
        $uploadPath = 'common/users/'.Yii::$app->user->id;

        FileHelper::createDirectory('common/users/'.Yii::$app->user->id.'/ads/');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model,'mini_image');
            $gallery = UploadedFile::getInstances($model,'gallery');
            if($image->saveAs($uploadPath . '/ads/' . $image->name)){
                $model->mini_image = $image->name;
            }
            $galleryArray = array();
            foreach($gallery as $item){
                $galleryArray[] .= $item->name;
                $item->saveAs($uploadPath . '/ads/' . $item->name);
            }
            $model->gallery = serialize($galleryArray);

            $model->save();
            Yii::$app->session->setFlash('success', 'Объявление создано');
            return $this->redirect(['user/index']);
        }

        return $this->render('my-ads/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAdsUpdate($id)
    {
        $model = $this->findModel($id);
        $mini_image = $model->mini_image;
        $gallery = unserialize($model->gallery);
        $uploadPath = 'common/users/'.Yii::$app->user->id;

        /**
         * Delete image from gallery
         */
        if(Yii::$app->request->isAjax && (Yii::$app->request->post('deleteImage') == 1)){
            $imageId = (int)Yii::$app->request->post('imageId');
            unset($gallery[$imageId]);
            $model->gallery = serialize($gallery);
            $model->save();
            return false;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($this->getUploadFileName(Yii::$app->user->id, 'mini_image')) {
                $model->mini_image = $this->getUploadFileName(Yii::$app->user->id, 'mini_image');
            } else {
                $model->mini_image = $mini_image;
            }

            $galleryModel = UploadedFile::getInstances($model,'gallery');
            foreach($galleryModel as $item){
                $gallery[] .= $item->name;
                $item->saveAs($uploadPath . '/ads/' . $item->name);
            }
            $model->gallery = serialize($gallery);

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Объявление сохранено');
                return $this->redirect(['user/index']);
            }
        }

        return $this->render('my-ads/update', [
            'model' => $model,
            'gallery' => $gallery
        ]);
    }

    /**
     * Deletes an existing Ads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Ads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Ads::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getUploadFileName($id, $params) {
        $model = new Ads();
        $image = UploadedFile::getInstance($model, $params);
        if ($image->name) {
            if ($model->load($_POST)) {
                $model->$params = $image;
                if ($model->validate()) {
                    FileHelper::createDirectory('common/users/'.$id.'/ads/');
                    $dir = Yii::getAlias('common/users/'.$id.'/ads/');
                    $image->saveAs($dir . $model->$params);
                    return $image->name;
                }
            }
        } else {
            return false;
        }
    }

}