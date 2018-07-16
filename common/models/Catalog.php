<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $title
 * @property string $title_en
 * @property string $title_kz
 * @property string $description
 * @property string $description_en
 * @property string $description_kz
 * @property string $keywords
 * @property string $keywords_en
 * @property string $keywords_kz
 * @property string $text
 * @property string $text_en
 * @property string $text_kz
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
            [['title','title_en','title_kz', 'name_en', 'name_kz', 'description', 'description_en', 'description_kz', 'keywords', 'keywords_en', 'keywords_kz', 'text', 'text_en', 'text_kz', 'recommended', 'url'], 'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'name_kz' => 'Название kz',
            'name_en' => 'Название en',
            'url' => 'Алиас',
            'title' => 'Тайтл',
            'title_en' => 'Тайтл en',
            'title_kz' => 'Тайтл kz',
            'description' => 'Description',
            'description_en' => 'Description en',
            'description_kz' => 'Description kz',
            'keywords' => 'Keywords',
            'keywords en' => 'Keywords en',
            'keywords kz' => 'Keywords kz',
            'text' => 'Текст',
            'text_en' => 'Текст en',
            'text_kz' => 'Текст kz',
            'image' => 'Изображение',
        ];
    }

}
