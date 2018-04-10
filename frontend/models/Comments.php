<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.03.2018
 * Time: 15:09
 */

namespace frontend\models;


use yii\db\ActiveRecord;
/**
 * SignupCompany model
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $fio
 * @property integer $date
 * @property string $load_photo
 * @property boolean $active
 * @property integer $user_id
 * @property string $reviews
 * @property boolean $recommendation
 * @property string $message
 * @property string $user_photo
 */

class Comments extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%comments}}';
    }

    public function rules()
    {
        return [
            ['active', 'default', 'value' => 0],
            ['load_photo', 'trim'],
            ['reviews', 'trim'],
            ['recommendation', 'trim'],
            ['message', 'trim'],
            ['message', 'required'],

//            ['message', 'match', 'pattern'=>'/^[\w\s,]+$/',
//                'message'=>'В тегах можно использовать только буквы.'],
            ['message', 'match', 'pattern'=>'/^[\w\s\,\.\A-Za-zА-Яа-яs]+$/',
                'message' => 'Сообщение содержит недопустимые символы!'],
            ['message', 'string', 'length' => [0, 1000]],
            ['fio', 'trim'],
            ['user_photo', 'trim'],
        ];
    }
}