<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08.02.2018
 * Time: 16:33
 */

namespace frontend\models;

use common\models\UserInfo;
use Yii;
use yii\base\model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use common\models\User;

class PartnerProfile extends Model
{
    public $name_company;
    public $name_brand;
    public $about_company;
    public $country;
    public $city;
    public $street;
    public $additional_street;
    public $position_company;
    public $user_name;
    public $surname;
    public $website;
    public $mobile_phone_1;
    public $mobile_phone_3;
    public $mobile_phone_2;
    public $city_phone_1;
    public $city_phone_2;
    public $mailindex;
    public $user_photo;
    public $password;
    public $repassword;
    public $email;
    public $confemail;

    private $oldPass;

    function __construct()
    {
        parent::__construct();

        if ($this->getUserInfo()) {
            $arr = $this->getUserInfo()[0];
            if ($arr) {
                $this->name_company = $arr['name_company'];
                $this->name_brand = $arr['name_brand'];
                $this->about_company = $arr['about_company'];
                $this->country = $arr['country'];
                $this->city = $arr['city'];
                $this->street = $arr['street'];
                $this->additional_street = $arr['additional_street'];
                $this->user_name = $arr['user_name'];
                $this->surname = $arr['user_name'];
                $this->position_company = $arr['position_company'];
                $this->website = $arr['website'];
                $this->mobile_phone_1 = $arr['mobile_phone_1'];
                $this->mobile_phone_2 = $arr['mobile_phone_2'];
                $this->mobile_phone_3 = $arr['mobile_phone_3'];
                $this->city_phone_1 = $arr['city_phone_1'];
                $this->city_phone_2 = $arr['city_phone_2'];
                $this->user_photo = $arr['user_photo'];
                $this->mailindex = $arr['mailindex'];
                $this->email = $arr['email'];
                $this->oldPass = $arr['password_hash'];
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['name_company', 'trim'],
            ['name_brand', 'trim'],
            ['about_company', 'trim'],
            ['street', 'trim'],
            ['additional_street', 'trim'],
            ['user_name', 'trim'],
            ['user_name', 'required', 'message' => 'Поле не может быть пустым!'],
            ['user_name', 'string', 'min' => 3, 'max' => 255],
            ['surname', 'trim'],
            ['surname', 'required', 'message' => 'Поле не может быть пустым!'],
            ['surname', 'string', 'min' => 3, 'max' => 255],
            ['position_company', 'trim'],
            ['website', 'trim'],
            ['mobile_phone_1', 'trim'],
            ['mobile_phone_2', 'trim'],
            ['mobile_phone_3', 'trim'],
            ['city_phone_1', 'trim'],
            ['city_phone_2', 'trim'],

            ['mailindex', 'trim'],

            ['country', 'trim'],

            ['city', 'trim'],

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
                $user->name_company = $this->name_company;
                $user->name_brand = $this->name_brand;
                $user->about_company = $this->about_company;
                $user->country = $this->country;
                $user->city = $this->city;
                $user->street = $this->street;
                $user->additional_street = $this->additional_street;
                $user->user_name = $this->user_name;
                $user->surname = $this->surname;
                $user->position_company = $this->position_company;
                $user->website = $this->website;
                $user->mobile_phone_1 = $this->mobile_phone_1;
                $user->mobile_phone_2 = $this->mobile_phone_2;
                $user->mobile_phone_3 = $this->mobile_phone_3;
                $user->city_phone_1 = $this->city_phone_1;
                $user->city_phone_2 = $this->city_phone_2;
                $user->mailindex = $this->mailindex;
                $user->user_photo = $this->uploadFile();
                $user->auth_key = Yii::$app->security->generateRandomString();
                if ($this->password) {
                    $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
                } else {
                    $user->password_hash = $this->oldPass;
                }
                $user->email = $this->email;
                $user->save(false);
            } else {
                $user = new User();
                $user->name_company = $this->name_company;
                $user->name_brand = $this->name_brand;
                $user->about_company = $this->about_company;
                $user->country = $this->country;
                $user->city = $this->city;
                $user->street = $this->street;
                $user->additional_street = $this->additional_street;
                $user->user_name = $this->user_name;
                $user->surname = $this->surname;
                $user->position_company = $this->position_company;
                $user->website = $this->website;
                $user->mobile_phone_1 = $this->mobile_phone_1;
                $user->mobile_phone_2 = $this->mobile_phone_2;
                $user->mobile_phone_3 = $this->mobile_phone_3;
                $user->city_phone_1 = $this->city_phone_1;
                $user->city_phone_2 = $this->city_phone_2;
                $user->mailindex = $this->mailindex;
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
        $model = new PartnerProfile();
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