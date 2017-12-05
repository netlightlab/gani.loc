<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.11.2017
 * Time: 12:31
 */

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\rbac\DbManager;


/**
 * UserInfo model
 *
 * @property integer $id
 * @property integer $users_id
 * @property string $user_name
 * @property string $city
 * @property string $phone
 * @property string $information
 * @property string $bdate
 * @property string $country
 * @property string $adres
 * @property string $mailindex
 * @property string $surname
 * @property string $user_photo
 */

class UserInfo extends ActiveRecord
{
//    protected $tableName;
//
//    function __construct($db = false){
//        parent::__construct();
//        switch($db){
//            case "users_info":
//                $this->tableName = '{{%users_info}}';
//                break;
//            default :
//                $this->tableName = '{{%users_info}}';
//                break;
//        }
//    }

    public static function tableName()
    {
        return '{{%users_info}}';
    }


    public function getUserInfo($userId){
        return static::find()->where(["users_id" => $userId])->asArray()->all();
    }

    public static function getAvatar($id){
        $avatar = static::find()->where(["users_id" => $id])->asArray()->one();
        return $avatar->user_photo;
    }
}