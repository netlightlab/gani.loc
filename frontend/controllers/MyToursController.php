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
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\Cities;


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
    public function actionAdd() {
        $model = new Tours();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->user_id = Yii::$app->user->id;

            $backgroundImage = UploadedFile::getInstance($model, 'back_image');
            $minimalImage = UploadedFile::getInstance($model, 'mini_image');
            $gallery = UploadedFile::getInstances($model, 'gallery');

            if($backgroundImage){
                $model->back_image = $backgroundImage->name;
            }
            if($minimalImage){
                $model->mini_image = $minimalImage->name;
            }
            if($gallery){
                $galleryArray = array();
                foreach($gallery as $item){
                    $galleryArray[] .= $item->name;
                }
                $model->gallery = serialize($galleryArray);
            }


            $model->save();

            FileHelper::createDirectory('common/tour_img/' . $model->id . '/');
            $dir = Yii::getAlias('common/tour_img/' . $model->id . '/');

            if($backgroundImage){
                $backgroundImage->saveAs($dir.'/'.$backgroundImage->name);
            }
            if($minimalImage){
                $minimalImage->saveAs($dir.'/'.$minimalImage->name);
            }
            if($gallery){
                foreach($gallery as $item){
                    $item->saveAs($dir.'/'.$item->name);
                }
            }

            Yii::$app->session->setFlash('success', 'Тур успешно добавлен');
            return $this->redirect(['/partner/index']);
        }

        /*if ($model->load(Yii::$app->request->post())) {
            if ($model->addTour()) {
                if($image1->name && $image2->name) {
//                    $this->refresh();
                    FileHelper::createDirectory('common/tour_img/' . $model->id . '/');
                    $dir = Yii::getAlias('common/tour_img/' . $model->id . '/');
                    $image1->saveAs($dir . $image1->name);
                    $image2->saveAs($dir . $image2->name);
                }

                Yii::$app->session->setFlash("success", "Тур успешно добавлен");
            } else {
                Yii::$app->session->setFlash("error", "Ошибка");
            };
        };*/

        /*$fileName = 'file';
        $uploadPath = 'common/tour_img/'.$model->id;

        if (isset($_FILES[$fileName])) {
            $file = UploadedFile::getInstancesByName($fileName);

            print_r($file);
            print_r($_FILES);

            foreach ($file as $item) {
                $item->saveAs($uploadPath . '/' . $item->name);
            }
        }*/

        if (Yii::$app->request->isAjax) {
            $cities = new Cities();
            $arr = $cities->getCitiesList((int)Yii::$app->request->post('country_id'));
            echo json_encode($arr);
            return false;
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }

    public function actionEdit($id) {
        $model = $this->findModel($id);
        $galleryImages = unserialize($model->gallery);
        $backgroundImage = $model->back_image;
        $minimalImage = $model->mini_image;

        $checkTour = Tours::find()->where(['id' => $id])->one();
        if ($checkTour->user_id != Yii::$app->user->id) {
            return $this->goHome();
        };


        /**
         * Delete image from gallery
         */
        if(Yii::$app->request->isAjax && (Yii::$app->request->post('deleteImage') == 1)){
            $imageId = (int)Yii::$app->request->post('imageId');
            unset($galleryImages[$imageId]);
            $model->gallery = serialize($galleryImages);
            $model->save();
            return false;
        }

        $uploadPath = 'common/tour_img/'.$id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $backImage = UploadedFile::getInstance($model, 'back_image');
            $miniImage = UploadedFile::getInstance($model, 'mini_image');
            $gallery = UploadedFile::getInstances($model, 'gallery');

            if ($gallery) {
                foreach ($gallery as $item) {
                    $galleryImages[] .= $item->name;
                    $item->saveAs($uploadPath . '/' . $item->name);
                }
            }
            if ($backImage){
                $model->back_image = $backImage->name;
                $backImage->saveAs($uploadPath . '/' . $backImage->name);
            }else{
                $model->back_image = $backgroundImage;
            }

            if($miniImage){
                $model->mini_image = $miniImage->name;
                $miniImage -> saveAs($uploadPath . '/' . $miniImage->name);
            }else{
                $model->mini_image = $minimalImage;
            }


            $model->gallery = serialize($galleryImages);

            $model -> save();
            Yii::$app->session->setFlash("success", "Тур успешно изменен");
            return $this->redirect(['/partner/index']);
        };


        if (Yii::$app->request->isAjax) {
            $cities = new Cities();
            $arr = $cities->getCitiesList((int)Yii::$app->request->post('country_id'));
            echo json_encode($arr);
            return false;
        }

        return $this->render('edit', [
            'model' => Tours::findOne($id),
            'gallery' => $galleryImages
        ]);
    }

    protected function findModel($id) {
        if (($model = Tours::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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

        Yii::$app->session->setFlash('success', 'Тур успешно удален');
        return $this->redirect(['/partner/index']);
    }

    public function statusTour($id) {
        return Tours::find()->where(['id' => $id])->orderBy('status')->one();
    }

}