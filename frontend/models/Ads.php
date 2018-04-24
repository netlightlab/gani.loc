<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.04.2018
 * Time: 9:16
 */

namespace frontend\models;


use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;

/**
 * Ads model -> модель объявлении
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

<<<<<<< HEAD
            [['mini_image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif'],
            [['gallery'], 'file', 'skipOnEmpty' => false, 'extensions' => 'gif, jpg, jpeg, png'],
=======
            ['mini_image', 'file'],
//            [['mini_image'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
            [['gallery'], 'file', 'extensions' => 'gif, jpg, jpeg, png', 'maxFiles' => 10],
>>>>>>> 4c89e917cc61627eac4b5d1e877314bad52e0fb4
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'active'        => 'Active',
            'user_id'       => 'ID user',
            'phone'         => 'Phone number',
            'description'   => 'Ads description',
            'mini_image'    => 'Back image',
            'gallery'       => 'Gallery images',
        ];
    }


}