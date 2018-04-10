<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupCompany */

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
                <h2 class="py-3 registr-description" align="center">Регистрация для Партнеров</h2>
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
    <div class="container" style="background: #fff; border: 1px solid #cccccc;">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-left pt-3">
                        <h3>Основная информация</h3>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'name_company')->textInput(['placeholder' => 'Например: TOO KazTravel'])->label('ОФИЦИАЛЬНОЕ НАЗВАНИЕ КОМПАНИИИ*') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'name_brand')->textInput(['placeholder' => 'Например: KazTravel'])->label('НАЗВАНИЕ БРЕНДА*') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'country')->dropDownList([
                        'КАЗАХСТАН',
                        'РОССИЯ',
                    ])->label('СТРАНА*') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'city')->dropDownList([
                        'АЛМАТЫ',
                        'АСТАНА',
                    ])->label('ГОРОД*') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'about_company')->textarea(['placeholder' => 'Краткое описание компании. Максимум 1000 символов', 'rows' => '8'])->label('ОПИСАНИЕ КОМПАНИИ') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-left">
                        <h3>Основная информация</h3>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'street')->textInput(['placeholder' => 'Например: Ул. Зеина Шашкина 3а'])->label('УЛИЦА И НОМЕР ДОМА') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'additional_street')->textInput(['placeholder' => 'Например: Заезд со стороны Шашкина не доезжая Бц Каспии'])->label('ДОПОЛНИТЕЛЬНЫЕ СВЕДЕНИЯ ОБ АДРЕСЕ') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'mailindex')->textInput(['placeholder' => 'Например: 050000'])->label('ПОЧТОВЫЙ ИНДЕКС') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-left">
                        <h3>Контактная информация</h3>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <?= $form->field($model, 'user_name')->textInput(['placeholder' => 'Например: Иван Иванович'])->label('КОНТАКТНОЕ ЛИЦО: ИМЯ/ОТЧЕСТВО') ?>
                </div>
                <div class="col-md-4 col-xs-4">
                    <?= $form->field($model, 'surname')->textInput(['placeholder' => 'Например: Иванов'])->label('ФАМИЛИЯ') ?>
                </div>
                <div class="col-md-4 col-xs-4">
                    <?= $form->field($model, 'position_company')->textInput(['placeholder' => 'Например: Директор'])->label('ДОЛЖНОСТЬ') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <?= $form->field($model, 'website')->textInput(['placeholder' => 'Например: el-tour.kz'])->label('ВЕБ-САЙТ') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'mobile_phone_1')->label('телефон (сотовый)')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '9 (999) 999-9999',
                    ])->textInput(['placeholder' => 'Например: 8 (777) 777-7777']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'mobile_phone_2')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '9 (999) 999-9999',
                    ])->label('телефон (сотовый)')->textInput(['placeholder' => 'Например: 8 (777) 777-7777']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'mobile_phone_3')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '999 (999) 99-99',
                    ])->label('телефон (городской)')->textInput(['placeholder' => 'Например: 727 (232) 77-77']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'city_phone_1')->label('телефон (городской)')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '999 (999) 99-99',
                    ])->textInput(['placeholder' => 'Например: 727 (232) 77-77']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'city_phone_2')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '999 (999) 99-99',
                    ])->label('телефон (городской)')->textInput(['placeholder' => 'Например: 727 (232) 77-77']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-left">
                        <h3>Информация для входа</h3>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Например: info@kaztravel.kz'])->label('E-mail*') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'password')->passwordInput()->label('ПАРОЛЬ*') ?>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-6 col-md-6">
                    <?= $form->field($model, 'repassword')->passwordInput()->label('ПОДТВЕРДИТЬ ПАРОЛЬ*') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pb-3">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'authorization-btn', 'name' => 'signup-button']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>
