<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
?>

<section class="section-header" style="background: url('common/img/header/authorization.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="authorization-block">
                    <div style="width: 100%; text-align: center;">
                        <h3 style="color: orange;">Авторизация</h3>
                    </div>
                    <hr class="white-line">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => "Например: KazTravel@mail.ru"])->label('E-mail') ?>
                        <?= $form->field($model, 'password')->passwordInput()->label('Пароль')?>
                        <?= $form->field($model, 'rememberMe')->checkbox()->label("Запонмить меня") ?>
                        <div style="color:#999;margin:1em 0">
                            <?= Html::a('Забыли пароль?', ['site/request-password-reset']) ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Войти', ['class' => 'authorization-btn', 'name' => 'login-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
