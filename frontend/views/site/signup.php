<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\MaskedInput;

$this->title = 'Регистрация';
?>


<section class="section-header" style="background: url('common/img/header/registration.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="py-3 registr-description" align="center">Регистрация</h2>
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
                    <h3>Информация для входа</h3>
                </div>
                <hr>
            </div>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Например: Иван'])->label('Отображаемое имя*') ?>
                </div>
                <div class="offset-md-3 col-md-6">
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Например: info@KazTravel.kz'])->label('E-mail*') ?>
                </div>
                <div class="offset-md-3 col-md-6">
                    <?= $form->field($model, 'password')->passwordInput()->label('Придумайте пароль*') ?>
                </div>
                <div class="offset-md-3 col-md-6">
                    <div class="form-group">
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'authorization-btn', 'name' => 'signup-button']) ?>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 pb-3">
                    <?= Html::a('Регистрация для партнера',['signup_company'], ['class' => 'registr-partner-btn']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>