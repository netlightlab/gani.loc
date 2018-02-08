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
    public $user_name;
//    public $users_id;
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
    public $oldpassword;
    public $confpassword;
    public $email;

    public static function tableName() {
        return '{{%user}}';
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