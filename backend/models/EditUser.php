<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.11.2017
 * Time: 17:03
 */

namespace backend\models;
use yii\base\Model;
use common\models\UserInfo;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class EditUser extends Model
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

//    private $userTable = '{{%user}}';
//    private $userInfoTable = '{{%users_info}}';

    /*public static function tableName()
    {
        return '{{%users_info}}';
    }*/

    /*function __construct(){
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
    }*/

    /**
     * @inheritdoc
     */
    /*public function rules()
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
    }*/

    /**
     * Signs user up.
     *
     * @return UserInfo|null the saved model or null if saving fails
     */
    /*public function edit()
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
    }*/

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
        return Yii::$app->request->get('id');
    }

    public function getUserInfo(){
        $userInfo = new UserInfo();
        $result = $userInfo->getUserInfo($this->getId());
        return $result;
    }

    public function uploadFile() {
        $model = new EditUser();
        $user_photo = UploadedFile::getInstance($model, 'user_photo');
        if($user_photo->name != $model->user_photo->name) {
            if ($model->load($_POST)) {
                $model->user_photo = $user_photo;
                if ($model->validate()) {
                    FileHelper::createDirectory('../images/users/' . $this->getId() . '/');
                    $dir = Yii::getAlias('@frontend/images/users/' . $this->getId() . '/');
                    $user_photo->saveAs($dir . $model->user_photo->name);
                    return $user_photo->name;
                }
            }
        } else {
            return $model->user_photo;
        }
    }
}