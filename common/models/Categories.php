<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property string $name_kz
 * @property string $name_en
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'name_kz', 'name_en'], 'required'],
            [['name', 'name_kz', 'name_en'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

    public function getCategoriesList(){
        $categories = self::find()->asArray()->all();
        $lang = Yii::$app->language;
        $result = [];
        foreach($categories as $category){
            if($lang === 'ru'){
                $result[$category['id']] = $category['name'];
            }elseif($lang === 'kz'){
                $result[$category['id']] = $category['name_kz'];
            }else{
                $result[$category['id']] = $category['name_en'];
            }
        }
        return $result;
    }

    public function getCategoryName($id) {
        $category = Categories::find()->where(['id' => $id])->one();
        /*$lang = Yii::$app->language;
        if($lang === 'ru'){
            return $category->name;
        }elseif($lang === 'kz'){
            return $category->name_kz;
        }else{
            return $category->name_en;
        }*/
        return $category->name;
    }
}
