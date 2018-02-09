<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09.02.2018
 * Time: 15:53
 */

namespace frontend\models;

use common\models\User;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\rbac\DbManager;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Tours model
 * @property integer $id
 * @property integer $user_id
 * @property integer $country_id
 * @property integer $place_id
 * @property integer $category_id
 * @property integer $city_id
 * @property string $name
 * @property string $description
 * @property string $mini_description
 * @property string $dot_place
 * @property string $dot_place_addr
 * @property string $tour_language
 * @property string $conditions
 * @property string $return_cond
 * @property string $back_image
 * @property string $mini_image
 * @property string $gallery
 * @property integer $price_child
 * @property integer $price_child_free
 * @property string $w_included
 * @property integer $status
 * @property integer $price
 */
class Tours extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tours}}';
    }

    public function rules()
    {
        return [

            ['status', 'default', 'value' => 1],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['user_id', 'trim'],
            ['country_id', 'trim'],
            ['place_id', 'trim'],
            ['category_id', 'trim'],
            ['city_id', 'trim'],
            ['name', 'trim'],
            ['description', 'trim'],
            ['mini_description', 'trim'],
            ['dot_place', 'trim'],
            ['tour_language', 'trim'],
            ['conditions', 'trim'],
            ['return_cond', 'trim'],
            ['back_image', 'trim'],
            ['mini_image', 'trim'],
            ['gallery', 'trim'],
            ['price_child', 'trim'],
            ['price_child_free', 'trim'],
            ['dot_place_addr', 'trim'],
            ['w_included', 'trim'],
            ['price', 'trim'],

        ];
    }

    public function addTour() {
        if ($this->validate()) {
            $this->user_id = Yii::$app->user->id;
            $this->back_image = $this->uploadFile('back_image');
            $this->mini_image = $this->uploadFile('mini_image');
            $this->gallery = $this->uploadFile('gallery');
            $this->save(false);
            return true;
        }
    }

    public function uploadFile($file) {
        $model = new Tours();
        $user_photo = UploadedFile::getInstance($model, $file);
        if($user_photo->name) {
            if ($model->load($_POST)) {
                $model->back_image = $user_photo;
                if ($model->validate()) {
                    FileHelper::createDirectory('common/users/' . Yii::$app->user->id . '/' . 'tour_image' . '/');
                    $dir = Yii::getAlias('common/users/' . Yii::$app->user->id . '/' . 'tour_image' . '/');
                    $user_photo->saveAs($dir . $user_photo->name);
                    return $user_photo->name;
                }
            }
        } else {
            return false;
        }
    }

    public function getTour($id) {
        $db_tour = new DbManager();
    }
}