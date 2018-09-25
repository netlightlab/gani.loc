<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="password-reset" style="padding: 10px;">

    <div style="    background: #168de2;
    padding-top: 8px;
    text-align: center;"><?= Html::a(Html::img('https://eltourism.kz/common/img/header/logo.png' ), 'https://eltourism.kz/') ?></div>

    <p>Здравствуйте, <strong><?= Html::encode($user->username) ?></strong>.</p>

    <p>Ваши авторизационные данные:<br>
        <span>Email: <?= $user->email ?></span><br>
    </p>

    <p>Ваш <?= Html::a('личный кабинет', 'https://eltourism.kz/user/index') ?>.</p>
</div>
