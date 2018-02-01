<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.01.2018
 * Time: 12:47
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

?>


<div class="container">
    <div class="site-signup">
        <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="col-md-12">
                <h3>Редактировать профиль</h3>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= $form->field($model, 'user_name')->textInput(['placeholder' => 'Например: Иван'])->label('Имя') ?>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= $form->field($model, 'surname')->label('Фамилия')->textInput(['placeholder' => 'Например: Петров']) ?>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= $form->field($model, 'phone')->label('Номер телефона')->textInput(['placeholder' => 'Например: 8 (707) 693-42-31']) ?>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= $form->field($model, 'bdate')->label('Дата рождения')->textInput(['placeholder' => 'Например: 17.02.1940']) ?>
            </div>
            <div class="col-md-12">
                <h3>Редактировать Адрес</h3>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= $form->field($model, 'adres')->label('Улица')->textInput(['placeholder' => 'Например: Фурманова 35']) ?>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= $form->field($model, 'city')->label('Город')->textInput(['placeholder' => 'Например: Алматы']) ?>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= $form->field($model, 'mailindex')->textInput(['placeholder' => 'Например: 99999'])->label('Почтовый индекс') ?>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= $form->field($model, 'country')->dropDownList([
                    'Казахстан',
                    'Россия',
                ])->label('Страна') ?>
            </div>

            <div class="col-md-12">
                <h3>Редактировать информацию</h3>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'information')->textarea(['rows' => '5'])->textarea(['placeholder' => 'Например: Ищу супервыгодные туры'])->label('О себе') ?>
            </div>
            <div class="col-md-12">
                <h3>Загрузить фотографию профиля</h3>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'user_photo')->fileInput()->label('') ?>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <a href="index.php?r=users%2Findex" class="btn btn-primary">Вернуться назад</a>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
