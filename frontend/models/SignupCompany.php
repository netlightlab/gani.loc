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
 * @property integer $mailindex
 * @property string $user_name
 * @property string $surname
 * @property string $position_company
 * @property string $website
 * @property integer $mobile_phone_1
 * @property integer $mobile_phone_2
 * @property integer $mobile_phone_3
 * @property integer $city_phone_1
 * @property integer $city_phone_2
 * @property string $email
 * @property string $password_hash
 * @property string $password write-only password
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $role
 * @property boolean $active
 */
class SignupCompany extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $repassword;
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['status', 'default', 'value' => 10],
            ['active', 'default', 'value' => 0],
            ['role', 'default', 'value' => 'partner'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

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
            ['mailindex', 'trim'],

            ['user_name', 'trim'],
            ['user_name', 'required', 'message' => 'Поле не может быть пустым!'],
            ['user_name', 'string', 'min' => 3, 'max' => 255],
            ['surname', 'trim'],
            ['surname', 'required', 'message' => 'Поле не может быть пустым!'],
            ['surname', 'string', 'min' => 3, 'max' => 255],

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
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Signs user up.
     *
     */

    public function signup()
    {
        if ($this->validate()) {
            $this->auth_key = Yii::$app->security->generateRandomString();
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

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

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

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
