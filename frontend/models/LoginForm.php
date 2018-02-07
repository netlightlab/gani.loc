<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\db\ActiveRecord;
use yii\db\Connection;
use yii\rbac\DbManager;


/**
 * Login form
 */
class LoginForm extends Model
{
//    public $username;
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required', 'message' => 'Поле не может быть пустым!'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['password', 'required', 'message' => 'Поле не может быть пустым!']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        $partner = new SignupCompany();
        $usr = new User();

        $rolePartn = $partner->getUsersRole($this->email);
        $roleUser = $usr->getUserRole($this->email);

        if ($rolePartn['partner']) {
            if (!$this->hasErrors()) {
                $user = $this->getPartner();
                if (!$user || !$user->validatePassword($this->password)) {
                    $this->addError($attribute, 'Не верный email или пароль');
                }
            }
        } elseif ($roleUser['user']) {
            if (!$this->hasErrors()) {
                $user = $this->getUser();
                if (!$user || !$user->validatePassword($this->password)) {
                    $this->addError($attribute, 'Не верный email или пароль');
                }
            }
        }
//        if (!$this->hasErrors()) {
//            $user = $this->getUser();
//            if (!$user || !$user->validatePassword($this->password)) {
//                $this->addError($attribute, 'Не верный email или пароль');
//            }
//        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $partner = new SignupCompany();
        $user = new User();

        $rolePartn = $partner->getUsersRole($this->email);
        $roleUser = $user->getUserRole($this->email);

        if ($rolePartn['partner']) {
            if ($this->validate()) {
//                echo "<script>alert('LOGIN PARTNER');</script>";
                return Yii::$app->user->login($this->getPartner(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            }
        } elseif($roleUser['user']) {
            if ($this->validate()) {
//                echo "<script>alert('LOGIN USER');</script>";
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
           }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }

    /**
     * Finds user by [[usermail]]
     *
     *
     */
    protected function getPartner()
    {
        if ($this->_user === null) {
            $this->_user = SignupCompany::findByEmail($this->email);
        }
        return $this->_user;
    }
}
