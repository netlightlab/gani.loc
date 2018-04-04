<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.03.2018
 * Time: 9:37
 */

$this->title = 'Оплата';

use yii\helpers\Html;
use common\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;

?>

<section class="section-header" style="background: url('../common/img/header/ms.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>ОПЛАТА</h2>
                    <p>Для осуществления покупки, необходимо авторизоваться.</p>
                </div>
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
                <?= Alert::widget() ?>
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