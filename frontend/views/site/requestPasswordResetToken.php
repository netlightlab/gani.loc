<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;

$this->title = 'Сброс пароля';
//$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section-header" style="background: url('../common/img/header/ms.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>Сброс пароля</h2>
                    <p>здесь вы можете сбросить свой пароль, в случае если вы его забыли.</p>
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
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5" style="background: #f9f9f9;">
    <div class="container" style="    background: #fff;
            border: 1px solid #cccccc;">
        <div class="row">
            <div class="col-md-12 py-5">
                <h3><?= Html::encode($this->title) ?></h3>
                <hr>
                <p>Пожалуйста, заполните свой адрес электронной почты. Вам будет отправлена ссылка на сброс пароля.</p>
                <hr>
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Укажите Email') ?>
                    <?= Html::submitButton('Сбросить', ['class' => 'my-btn', 'style' => 'width: 225px']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
