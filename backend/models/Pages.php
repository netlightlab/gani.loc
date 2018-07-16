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
 * @property string $content_kz
 * @property string $content_en
 * @property string $title
 * @property string $title_en
 * @property string $title_kz
 * @property string $page_title
 * @property string $page_title_kz
 * @property string $page_title_en
 * @property string $page_description
 * @property string $page_description_en
 * @property string $page_description_kz
 * @property string $page_keywords
 * @property string $page_keywords_kz
 * @property string $page_keywords_en
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
            [['title','url', 'title_en', 'title_kz', 'content_en', 'content_kz', 'page_title', 'page_title_en', 'page_title_kz','page_description','page_description_en','page_description_kz','page_keywords','page_keywords_en','page_keywords_kz'], 'trim'],
            [['title','content'], 'required'],
            [['active','show'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'title_kz' => 'Заголовок kz',
            'title_en' => 'Заголовок en',
            'page_title' => 'Тайтл',
            'page_title_en' => 'Тайтл en',
            'page_title_kz' => 'Тайтл kz',
            'page_description' => 'Дескрпишн',
            'page_description_en' => 'Дескрпишн en',
            'page_description_kz' => 'Дескрпишн kz',
            'page_keywords' => 'Кейвордс',
            'page_keywords_en' => 'Кейвордс en',
            'page_keywords_kz' => 'Кейвордс kz',
            'content' => 'Текст',
            'content_en' => 'Текст en',
            'content_kz' => 'Текст kz',
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