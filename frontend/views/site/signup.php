<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>

<section class="section-header" style="background: url('common/img/header/registration.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="authorization-block">
                    <div style="width: 100%; text-align: center;">
                        <h3 style="color: orange;">Регистрация</h3>
                    </div>
                    <hr class="white-line">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Например: Иван'])->label('Отображаемое имя') ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Например: info@KazTravel.kz'])->label('E-mail') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('Придумайте пароль') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'authorization-btn', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
