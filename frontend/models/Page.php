<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.12.2017
 * Time: 9:57
 */

namespace frontend\models;


use yii\db\ActiveRecord;
use Yii;

class Page extends ActiveRecord
{
    public $id;
    public $title;
    public $content;
    public $url;
    public $background;

    public static function tableName() {
        return '{{%page}}';
    }

    protected function getFields(){
        //return self::find()->where(["id" => $this->getId()])->asArray()->all();
        return self::find()->where(["id" => $this->getId()])->asArray()->one();
    }

    protected function getId(){
        return Yii::$app->request->get('id');
    }

    public function data(){
        $data = $this->getFields();

        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->url = $data['url'];
        $this->background = $data['background'];

        return true;
    }
}