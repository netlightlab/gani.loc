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
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\HttpException;
use yii\web\UploadedFile;


class EditProfile extends Model
{
    public $user_name;
    public $users_id;
    public $phone;
    public $city;
    public $information;
    public $bdate;
    public $country;
    public $adres;
    public $mailindex;
    public $surname;
    public $user_photo;

    function __construct()
    {
        parent::__construct();

        if ($this->getUserInfo()) {
            $arr = $this->getUserInfo()[0];
            if ($arr) {
                $this->user_name = $arr['user_name'];
                $this->phone = $arr['phone'];
                $this->city = $arr['city'];
                $this->information = $arr['information'];
                $this->bdate = $arr['bdate'];
                $this->surname = $arr['surname'];
                $this->mailindex = $arr['mailindex'];
                $this->adres = $arr['adres'];
                $this->country = $arr['country'];
                $this->user_photo = $arr['user_photo'];
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
            ['user_name', 'required', 'message' => 'Не заполнено поле!'],
            ['user_name', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required', 'message' => 'Не заполнено поле!'],

            ['adres', 'trim'],

            ['bdate', 'trim'],

            ['mailindex', 'trim'],

            ['country', 'trim'],

            ['city', 'trim'],
            ['city', 'required', 'message' => 'Не заполнено поле!'],

            ['information', 'trim'],

            ['surname', 'trim'],
            ['surname', 'required', 'message' => 'Не заполнено поле!'],
            ['surname', 'string', 'min' => 2, 'max' => 255],

            ['user_photo', 'file', 'extensions' => 'png, jpg'],
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
            if ($this->getUserInfo()) {
                $user = UserInfo::findOne(['users_id' => $this->getId()]);
                $user->users_id = $this->getId();
                $user->user_name = $this->user_name;
                $user->phone = $this->phone;
                $user->city = $this->city;
                $user->information = $this->information;
                $user->bdate = $this->bdate;
                $user->adres = $this->adres;
                $user->country = $this->country;
                $user->mailindex = $this->mailindex;
                $user->surname = $this->surname;
                $user->user_photo = $this->uploadFile();
                $user->save();
            } else {
                $user = new UserInfo();
                $user->users_id = $this->getId();
                $user->user_name = $this->user_name;
                $user->phone = $this->phone;
                $user->city = $this->city;
                $user->information = $this->information;
                $user->bdate = $this->bdate;
                $user->adres = $this->adres;
                $user->country = $this->country;
                $user->mailindex = $this->mailindex;
                $user->surname = $this->surname;
                $user->user_photo = $this->uploadFile();
                $user->save();
            }

            return true;
        }
    }

    protected function getId() {
        return Yii::$app->user->id;
    }

    public function getUserInfo(){
        $userInfo = new UserInfo();
        $result = $userInfo->getUserInfo($this->getId());
        return $result;
    }

    public function uploadFile() {
        $model = new EditProfile();

        if ($model->load($_POST)) {
            $user_photo = UploadedFile::getInstance($model, 'user_photo');
            $model->user_photo = $user_photo;
            if ($model->validate()) {
                $path = FileHelper::createDirectory('../images/users/' . $this->getId() . '/');
                $dir = Yii::getAlias('@frontend/images/users/' . $this->getId() . '/');
                $user_photo->saveAs($dir . $model->user_photo->name);
                return $user_photo->name;
            }
        }
    }

}