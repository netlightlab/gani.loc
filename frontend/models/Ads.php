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
 * @property resource $mini_image
 * @property resource $gallery
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
//            [['mini_image'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
            [['gallery'], 'file', 'extensions' => 'gif, jpg, jpeg, png'],
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