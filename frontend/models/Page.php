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

/**
 * Page model
 *
 * @property integer $id
 * @property string $content
 * @property string $content_kz
 * @property string $content_en
 * @property string $title
 * @property string $title_en
 * @property string $title_kz
 * @property integer $active
 * @property integer $show
 * @property string $background
 * @property string $url
 */

class Page extends ActiveRecord
{
    public static function tableName() {
        return '{{%page}}';
    }

    /*protected function getFields(){
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
    }*/
}