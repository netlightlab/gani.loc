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
use common\models\Menu as MenuItems;
use yii\helpers\Url;

class Menu extends Page
{
    public static function showMenu(){
        $values = $data = self::find()->select('id, title, show')->where(['active' => 1])->asArray()->all();
        foreach($values as $value){
            if($value['show'] == 1){
                echo Html::tag('li',
                        Html::a($value['title'], ['site/page', 'id' => $value['id']], ['class' => 'nav-link']),
//                        Url::toRoute(['/site/page', 'id' => $value['id']]),
                    ["class" => "nav-item"]);
            }
        }
    }

    public static function newMenu(){
        $items = MenuItems::find()->orderBy('sort')->all();
        foreach($items as $item){
            $link = $item->link ? ['site/page', 'id' => $item->link] : $item -> slink;
            echo Html::tag('li',
                //Html::a($item->name, $item->link ? '/site/page?id=' . $item->link : $item->slink, ['class' => 'nav-link']),
                Html::a($item->name,
//                    $item->link ? '/site/' . $item->link : $item->slink,
                    Url::to($link),
                    ['class' => 'nav-link']),
                ["class" => "nav-item"]);
        }
    }

    public static function showCab(){
        $user = new DbManager();
        $usersRole = key($user->getAssignments(Yii::$app->user->id));
        return Html::a(Html::img('@web/common/img/header/account.png')."Кабинет", ["{$usersRole}/index"], ["class" => "nav-link"]);
    }
}