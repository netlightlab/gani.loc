<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.12.2017
 * Time: 10:46
 */

namespace frontend\models;


use yii\helpers\Html;
use Yii;
use common\models\User;
use yii\rbac\DbManager;

class Menu extends Page
{
    public static function showMenu(){
        $values = $data = self::find()->select('id, title, show')->where(['active' => 1])->asArray()->all();
        foreach($values as $value){
            if($value['show'] == 1){
                echo Html::tag('li',
                        Html::a($value['title'], ['site/page', 'id' => $value['id']], ['class' => 'nav-link']),
                    ["class" => "nav-item"]);
            }
        }
    }

//    protected function getElements(){
//        return $data;
//    }

    public static function showCab(){
        $user = new DbManager();
        $usersRole = key($user->getAssignments(Yii::$app->user->id));
        return Html::a(Html::img('@web/common/img/header/account.png')."Кабинет", ["{$usersRole}/index"], ["class" => "nav-link"]);
//        return Html::a("Кабинет", ["{$usersRole}/index"], ["class" => "nav-link"]);
    }
}