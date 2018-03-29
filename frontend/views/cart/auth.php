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

?>

<div style="height:200px;"></div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?= Alert::widget() ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">

        </div>
    </div>
</div>