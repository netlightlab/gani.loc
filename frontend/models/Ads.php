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
 * @property string $title
 * @property string $description
 * @property string $description_en
 * @property string $mini_image
 * @property string $gallery
 *
 */
class Ads extends ActiveRecord
{
    public $body;

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

            ['title', 'trim'],
            ['title', 'required'],
            ['title', 'string', 'max' => 80],

            ['description', 'trim'],
            ['description_en', 'trim'],
            ['description', 'required', 'message' => 'Необходимо указать описание'],

            ['mini_image', 'file'],
//            [['mini_image'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
            [['gallery'], 'file', 'extensions' => 'gif, jpg, jpeg, png', 'maxFiles' => 10],
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
            'title'         => 'Title news',
            'description'   => 'Ads description',
            'mini_image'    => 'Back image',
            'gallery'       => 'Gallery images',
        ];
    }
}