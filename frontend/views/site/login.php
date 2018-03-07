<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\MaskedInput;

$this->title = 'Авторизация';
?>

<section class="section-header" style="background: url('common/img/header/authorization.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="py-3 registr-description" align="center">Авторизация</h2>
            </div>
        </div>
    </div>
</section>

<section style="background: #2e2e2e;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $this->params['breadcrumbs'][] = $this->title; ?>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5" style="background: #f9f9f9;">
    <div class="container" style="    background: #fff;
            border: 1px solid #cccccc;">
        <div class="row">
            <div class="col-md-12">
                <div class="text-left pt-3">
                    <h3>Заполните данные для входа</h3>
                </div>
                <hr>
            </div>
            <div class="col-md-12">
                <?= Alert::widget() ?>
            </div>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => "Например: info@kaztravel.kz"])->label('E-mail*') ?>
                </div>
                <div class="offset-md-3 col-md-6">
                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль*')?>
                </div>
                <div class="offset-md-3 col-md-6">
                    <?= $form->field($model, 'rememberMe')->checkbox()->label("Запонмить меня") ?>
                </div>
                <div class="offset-md-3 col-md-6">
                    <?= Html::a('Забыли пароль?', ['site/request-password-reset']) ?>
                </div>
                <div class="offset-md-3 col-md-6 pt-2">
                    <div class="form-group">
                        <?= Html::submitButton('Войти', ['class' => 'authorization-btn', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 pb-3 text-right" >
                    <span>Все ещё не <?= Html::a('зарегистрированы?',['signup']) ?></span>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>