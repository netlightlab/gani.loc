<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.11.2017
 * Time: 10:47
 */

namespace frontend\models;

use common\models\UserInfo;
use Yii;
use yii\base\model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use common\models\User;


class UserProfile extends Model
{
    public $user_name;
    public $phone;
    public $city;
    public $information;
    public $bdate;
    public $country;
    public $adres;
    public $mailindex;
    public $surname;
    public $user_photo;
    public $password;
    public $repassword;
    public $email;
    public $confemail;

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
                $this->email = $arr['email'];
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
            ['user_name', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'trim'],

            ['adres', 'trim'],

            ['bdate', 'trim'],

            ['mailindex', 'trim'],

            ['country', 'trim'],

            ['city', 'trim'],

            ['information', 'trim'],

            ['surname', 'trim'],
            ['surname', 'string', 'min' => 2, 'max' => 255],

            ['user_photo', 'file', 'extensions' => 'png, jpg'],

            ['email', 'trim'],
            ['confemail', 'trim'],
            ['confemail', 'compare', 'compareAttribute' => 'email', 'message' => Yii::t('app','Email не совпадает')],

            ['password', 'trim'],
            ['repassword', 'trim'],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', "Пароли не совпадают")],
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
                $user = User::findOne(['id' => $this->getId()]);
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
                $user->auth_key = Yii::$app->security->generateRandomString();
                $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
                $user->email = $this->email;
                $user->save(false);
            } else {
                $user = new User();
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
                $user->auth_key = Yii::$app->security->generateRandomString();
                $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
                $user->email = $this->email;
                $user->save(false);
            }

            return true;
        }
    }

    protected function getId() {
        return Yii::$app->user->id;
    }

    public function getUserInfo(){
        return User::getUserInfo();
    }

    public function uploadFile() {
        $model = new UserProfile();
        $user_photo = UploadedFile::getInstance($model, 'user_photo');
        if($user_photo->name != $model->user_photo->name) {
            if ($model->load($_POST)) {
                $model->user_photo = $user_photo;
                if ($model->validate()) {
                    FileHelper::createDirectory('common/users/' . $this->getId() . '/');
                    $dir = Yii::getAlias('common/users/' . $this->getId() . '/');
                    $user_photo->saveAs($dir . $model->user_photo->name);
                    return $user_photo->name;
                }
            }
        } else {
            return $model->user_photo;
        }
    }
}