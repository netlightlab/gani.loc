<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.2017
 * Time: 18:03
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>



<?php $form = ActiveForm::begin(['id' => 'form-page-create' , 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->textInput(['placeholder' => 'Например: О нас'])->label('Название') ?>
<?= $form->field($model, 'content')->textarea()->label('Текст') ?>
<?= $form->field($model, 'url')->textInput()->label('ЧПУ') ?>
<?= $form->field($model, 'active')->checkbox()->label('Активно') ?>
<?= $form->field($model, 'show')->checkbox()->label('Показать в меню') ?>
<?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
