<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property string $image
 * @property int $recommended
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['title', 'description', 'keywords', 'text', 'recommended'], 'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'image' => 'Изображение',
        ];
    }

}
