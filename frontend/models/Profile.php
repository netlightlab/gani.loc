<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.11.2017
 * Time: 10:47
 */

namespace frontend\models;


use yii\db\ActiveRecord;
use Yii;
use common\models\UserInfo;
use common\models\User;

class Profile extends ActiveRecord
{
    public static function tableName() {
        return '{{%users_info}}';
    }

    public static function getUserInfo() {
        return UserInfo::findOne(['users_id' => Yii::$app->user->id]);
    }

    public static function getUserLogin() {
        return User::findOne(['id' => Yii::$app->user->id]);
    }
}