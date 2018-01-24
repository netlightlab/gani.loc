<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use yii\web\HttpException;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\rbac\DbManager;

/**
 * SignupCompany model
 *
 * @property integer $id
 * @property string $name_company
 * @property string $name_brand
 * @property string $country
 * @property string $city
 * @property string $about_company
 * @property string $street
 * @property string $additional_street
 * @property integer $postcode
 * @property string $fio
 * @property string $position_company
 * @property string $website
 * @property integer $mobile_phone_1
 * @property integer $mobile_phone_2
 * @property integer $mobile_phone_3
 * @property integer $city_phone_1
 * @property integer $city_phone_2
 * @property integer $city_phone_3
 * @property string $email
 * @property string $password
 * @property string $id_tour
 */
class SignupCompany extends ActiveRecord
{
    private $_user;
    public $password_repeat;

    public static function tableName()
    {
        return '{{%partner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['name_company', 'trim'],
            ['name_company', 'required', 'message' => 'Поле не может быть пустым!'],
            ['name_company', 'unique'],
            ['name_company', 'string', 'min' => 6, 'max' => 255],

            ['name_brand', 'trim'],
            ['name_brand', 'required', 'message' => 'Поле не может быть пустым!'],
            ['name_brand', 'unique'],
            ['name_brand', 'string', 'min' => 2, 'max' => 255],

            ['country', 'trim'],
            ['country', 'required', 'message' => 'Поле не может быть пустым!'],

            ['city', 'trim'],
            ['city', 'required', 'message' => 'Поле не может быть пустым!'],

            ['about_company', 'trim'],
            ['street', 'trim'],
            ['street', 'required', 'message' => 'Поле не может быть пустым!'],
            ['additional_street', 'trim'],
            ['postcode', 'trim'],

            ['fio', 'trim'],
            ['fio', 'required', 'message' => 'Поле не может быть пустым!'],
            ['fio', 'string', 'min' => 3, 'max' => 255],

            ['position_company', 'trim'],
            ['website', 'trim'],

            ['mobile_phone_1', 'filter', 'filter' => function($value) {
                return $value;
            }],
            ['mobile_phone_2', 'filter', 'filter' => function($value) {
                return $value;
            }],
            ['mobile_phone_3', 'filter', 'filter' => function($value) {
                return $value;
            }],

            ['city_phone_1', 'filter', 'filter' => function($value) {
                return $value;
            }],
            ['city_phone_2', 'filter', 'filter' => function($value) {
                return $value;
            }],
            ['city_phone_3', 'filter', 'filter' => function($value) {
                return $value;
            }],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Поле не может быть пустым!'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['password, password_repeat', 'required', 'on' => 'create'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => array('create', 'update')],
            ['password_repeat', 'safe'],


            //['password', 'required', 'message' => 'Поле не может быть пустым!'],
//            ['password', 'compare'],
//            ['password', 'string', 'min' => 6],
//            ['password, password_repeat', 'required', 'on' => 'create'],
//            ['password, password_repeat', 'length', 'min' => 6, 'max' => 30, 'on' => array('create', 'update')],
//            ['password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => array('create', 'update')],
//            ['password, password_repeat', 'length', 'min' => 8, 'max' => 30],
//            ['password', 'required', 'on' => 'update'],
//            ['password', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают, попробуйте снова.', 'on' => 'update'],
//            ['password', 'string', 'min' => 6],
        ];
    }

//    /**
//     * Signs user up.
//     *
//     * @return User|null the saved model or null if saving fails
//     */

    public function signup()
    {
        if ($this->validate()) {

            $user = new User();

            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('user');
            $auth->assign($authorRole, 9999);

            $this->save();

            return true;
        }

        return null;
    }

//    public function getId()
//    {
//        return $this->getPrimaryKey();
//    }
//
//    public function login()
//    {
//        if ($this->validate()) {
//            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
//        }
//
//        return false;
//    }
//
//    protected function getUser(){
//        if ($this->_user === null) {
//            $this->_user = self::findByEmail($this->email);
//        }
//        return $this->_user;
//    }
//
//    protected static function findByEmail($email){
//        return static::findOne([
//            'email' => $email
//        ]);
//    }

//    public function signup()
//    {
//        if ($this->validate()) {
//            $user = new User();
//            $user->username = $this->username;
//            $user->email = $this->email;
//            $user->setPassword($this->password);
//            $user->generateAuthKey();
//            //$user->save(false);
//            $user->save(false);
//
//            $auth = Yii::$app->authManager;
//            $authorRole = $auth->getRole('user');
//            $auth->assign($authorRole, $user->getId());
//
//            return $user;
//        }
//
//        return null;
//    }
}
