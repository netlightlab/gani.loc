<?php
namespace frontend\models;

use Yii;
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
 * @property string $id_tour
 * @property string $password_hash
 * @property string $password write-only password
 */
class SignupCompany extends ActiveRecord implements IdentityInterface
{

    public $repassword;
    public $password;

    /**
     * @inheritdoc
     */
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

            ['password', 'required', 'message' => 'Поле не может быть пустым!'],
            ['repassword', 'required', 'message' => 'Поле не может быть пустым!'],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', "Пароли не совпадают")],
        ];
    }

    /**
     * Signs user up.
     *
     */

    public function signup()
    {
        if ($this->validate()) {
            $this->setPassword($this->password);
            $this->save(false);

            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('partner');
            $auth->assign($authorRole, $this->getId());

            return true;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public static function findIdentity($id) {}
    public static function findIdentityByAccessToken($token, $type = null) {}
    public function getAuthKey() {}
    public function validateAuthKey($authKey) {}

    /* Получаем объект роли
     * по email пользователя
     */

    public function getUsersRole($email) {
        $id = static::findOne(['email' => $email])->id;
        $db = new DbManager();
        $role = $db->getRolesByUser($id);
        return $role;
    }

    public static function findByEmail($email) {
        return static::findOne([
            'email' => $email
        ]);
    }
}
