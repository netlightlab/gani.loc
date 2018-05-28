<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $banner
 * @property string $link
 * @property string $position
 * @property int $page_id
 */
class Banners extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'position', 'page_id'], 'required'],
            [['banner', 'link'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'banner' => 'Изображение (баннер)',
            'link' => 'URL - сайт рекламодателя',
            'position' => 'Позиция размещения',
            'page_id' => 'Страница размещения',
        ];
    }

    public function getPageList(){
        $arr = [
            '1' => "Главная",
            '2' => "Все туры/Поиск",
        ];
        return $arr;
    }

    public function getPositionList($country_id){
        $arr = [
            '1' => ([
                'home_top' => 'Top',
                'home_mid' => 'Middle',
                'home_bottom' => 'Bottom',
            ]),
            '2' => ([
                'page_left' => 'Left',
            ])
        ];
        return $arr[$country_id];
    }

}
