<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
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
 * @property string $description
 * @property string $description_en
 * @property string $description_kz
 * @property string $image
 * @property string $url
 * @property int $date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'url', 'title_en', 'title_kz'], 'string', 'max' => 255],
            [['title', 'description', 'description_en', 'description_kz', 'image', 'date', 'title_en', 'title_kz', 'page_title', 'page_title_en', 'page_title_kz','page_description','page_description_en','page_description_kz','page_keywords','page_keywords_en','page_keywords_kz'], 'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'title_en' => 'Заголовок en',
            'title_kz' => 'Заголовок kz',
            'page_title' => 'Тайтл',
            'page_title_en' => 'Тайтл en',
            'page_title_kz' => 'Тайтл kz',
            'page_description' => 'Дескрпишн',
            'page_description_en' => 'Дескрпишн en',
            'page_description_kz' => 'Дескрпишн kz',
            'page_keywords' => 'Кейвордс',
            'page_keywords_en' => 'Кейвордс en',
            'page_keywords_kz' => 'Кейвордс kz',
            'description' => 'Текст',
            'description_en' => 'Текст en',
            'description_kz' => 'Текст kz',
            'image' => 'Изображение',
            'url' => 'Алиас',
            'date' => 'Дата',
        ];
    }

}
