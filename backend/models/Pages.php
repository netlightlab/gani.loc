<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.2017
 * Time: 13:20
 */

namespace backend\models;
use frontend\models\Page;
use yii\db\ActiveRecord;
use Yii;

/**
 * Pages model
 *
 * @property integer $id
 * @property string $content
 * @property string $title
 * @property integer $active
 * @property integer $show
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
            'title' => 'title',
            'content' => 'content',
            'background' => 'background',
            'url' => 'url',
            'show' => 'show',
            'active' => 'active',
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
}