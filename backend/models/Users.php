<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.11.2017
 * Time: 18:02
 */
namespace backend\models;
use yii\db\ActiveRecord;
use yii\base\Model;
use common\models\User;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\DbManager;

class Users extends ActiveRecord
{

    public $password;

    public static function tableName() {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            ['user_name', 'trim'],
            ['user_name', 'string', 'min' => 2, 'max' => 255],

            [['phone', 'adres', 'bdate', 'mailindex', 'country', 'city', 'information', 'name_company', 'email'], 'trim'],

            ['email', 'email'],

            ['about_company', 'string', 'max' => 1000],

            ['surname', 'trim'],
            ['surname', 'string', 'min' => 2, 'max' => 255],

            ['user_photo', 'file', 'extensions' => 'png, jpg'],

            ['active', 'boolean'],
            /*[ 'trim'],*/
           /* ['confemail', 'trim'],
            ['confemail', 'compare', 'compareAttribute' => 'email', 'message' => Yii::t('app','Email не совпадает')],

            ['password', 'trim'],
            ['repassword', 'trim'],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', "Пароли не совпадают")],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Город',
            'country_parent' => 'Страна',
            'role' => 'Роль',
            'status' => 'Статус'
        ];
    }

    private $rolesTable = '{{%auth_item}}';
    protected $usersRoleTable = '{{%auth_assignment}}';
    private $userTable = '{{%user}}';
    public $usersRole;

    public function getAllUsers(){
        $users = (new Query())->from($this->userTable)->all();
        return $users;
    }

    public function editUserById($id){
        $user = (new Query())->from($this->userTable)->where(["id" => $id])->all();
        return $user;
    }

    public function getUsersRoleById($id){
        $query = (new Query())->from($this->usersRoleTable)
                ->where(['user_id' => $id])
                ->one();
        return $query;
    }

}