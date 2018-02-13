<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.2017
 * Time: 13:20
 */

namespace backend\models;
use yii\db\ActiveRecord;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;


/**
 * Pages model
 *
 * @property integer $id
 * @property string $content
 * @property string $title
 * @property integer $active
 * @property integer $show
 * @property string $background
 * @property string $url
 */

class Pages extends ActiveRecord
{
    public static function tableName() {
        return '{{%page}}';
    }

    public function rules()
    {
        return [
            [['title','url'], 'trim'],
            [['title','content'], 'required'],
            [['active','show'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'content' => 'Текст',
            'background' => 'Изображение',
            'url' => 'url',
            'show' => 'Показать',
            'active' => 'Активно',
        ];
    }

    public function getPages(){
        return self::find()->select("id, title")->asArray()->all();
    }

    public function getPage(){
        if(Yii::$app->request->get('id')){
            return self::find()->where(["id" => Yii::$app->request->get('id')])->one();
        }else{
            return false;
        }
    }

    public function fileUpload(){

    }

}