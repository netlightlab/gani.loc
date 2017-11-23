<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.11.2017
 * Time: 10:47
 */

namespace frontend\models;

use common\models\UserInfo;
use yii\db\ActiveRecord;
use Yii;
use yii\base\model;
use yii\db\Query;
use yii\web\HttpException;
use yii\web\User;


class EditProfile extends Model
{
    public $user_name;
    public $users_id;
    public $phone;
    public $city;
    public $information;

//    private $userTable = '{{%user}}';
//    private $userInfoTable = '{{%users_info}}';

    /*public static function tableName()
    {
        return '{{%users_info}}';
    }*/

    function __construct(){
        parent::__construct();

        if($this->getUserInfo()){
            $arr = $this->getUserInfo()[0];
            if($arr){
                $this->user_name = $arr['user_name'];
                $this->phone = $arr['phone'];
                $this->city = $arr['city'];
                $this->information = $arr['information'];
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_name', 'trim'],
            ['user_name', 'required'],
            ['user_name', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required'],

            ['city', 'required'],

            ['information', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return UserInfo|null the saved model or null if saving fails
     */
    public function edit()
    {
        if ($this->validate()) {
            if($this->getUserInfo()) {
                $user = UserInfo::findOne(['users_id' => $this->getId()]);
                $user->users_id = $this->getId();
                $user->user_name = $this->user_name;
                $user->phone = $this->phone;
                $user->city = $this->city;
                $user->information = $this->information;
                $user->save();
            } else {
                $user = new UserInfo();
                $user->users_id = $this->getId();
                $user->user_name = $this->user_name;
                $user->phone = $this->phone;
                $user->city = $this->city;
                $user->information = $this->information;
                $user->save();
            }

            return true;
        }

        return null;
    }

    protected function getId() {
        return Yii::$app->user->id;
    }

    public function getUserInfo(){
        $userInfo = new UserInfo();
        $result = $userInfo->getUserInfo($this->getId());
        return $result;
    }


}