<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.12.2017
 * Time: 10:46
 */

namespace frontend\models;


use yii\helpers\Html;

class Menu extends Page
{
    public static function showMenu(){
        $values = $data = self::find()->select('id, title, show')->where(['active' => 1])->asArray()->all();
        foreach($values as $value){
            if($value['show'] == 1){
                echo Html::tag('li',
                        Html::a($value['title'], ['site/page&id='.$value['id']], ['class' => 'nav-link']),
                    ["class" => "nav-item"]);
            }
        }
    }

    protected function getElements(){



        return $data;
    }
}