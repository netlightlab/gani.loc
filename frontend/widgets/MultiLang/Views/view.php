<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.06.2018
 * Time: 11:37
 */

namespace frontend\widgets\MultiLang;
use yii\helpers\Html;
use Yii;
?>

<div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="color: #fff">
        <span class="uppercase"><?= Yii::$app->language; ?></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li class="item-lang">
            <?= Html::a('English', array_merge(
                    Yii::$app->request->get(),
                    [Yii::$app->controller->route, 'language' => 'en']
            )); ?>
        </li>
        <li class="item-lang">
            <?= Html::a('Русский', array_merge(
                Yii::$app->request->get(),
                [Yii::$app->controller->route, 'language' => 'ru']
            )); ?>
        </li>
        <li class="item-lang">
            <?= Html::a('Қазақша', array_merge(
                Yii::$app->request->get(),
                [Yii::$app->controller->route, 'language' => 'kz']
            )); ?>
        </li>
    </ul>
</div>