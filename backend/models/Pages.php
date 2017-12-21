<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.2017
 * Time: 13:20
 */

namespace backend\models;

use frontend\models\Page;

class Pages extends Page
{
    public $active = true;
    public $show = true;

    public function rules()
    {
        return [
            ['title', 'trim'],
            ['title', 'required'],
            ['active', 'boolean'],
            ['show', 'boolean'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            //$user->save(false);
            $user->save(false);

            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('user');
            $auth->assign($authorRole, $user->getId());

            return $user;
        }

        return null;
    }

    public function getPages(){
        return self::find()->select("id, title")->asArray()->all();
    }

    public function create(){
        if ($this->validate()) {
            
        }
    }
}