<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.04.2018
 * Time: 9:16
 */

namespace frontend\models;


use yii\db\ActiveRecord;

/**
 * Ads model -> объявления
 * @property integer $id
 * @property integer $user_id
 * @property integer $phone
 * @property string $description
 * @property string $mini_image
 * @property string $gallery
 *
 */
class Ads extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ads}}';
    }

    public function rules()
    {
        return [
            ['active', 'default', 'value' => 1],
            ['user_id', 'trim'],

            ['phone', 'trim'],
            ['phone', 'required', 'message' => 'Необходимо указать телефон'],

            ['description', 'trim'],
            ['description', 'required', 'message' => 'Необходимо указать описание'],

            ['mini_image', 'trim'],
            ['gallery', 'trim'],
        ];
    }

}