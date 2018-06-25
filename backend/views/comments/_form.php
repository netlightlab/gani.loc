<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'load_photo')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'reviews')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'recommendation')->textInput() ?>

    <?= $form->field($model, 'message')->textarea(['maxlength' => true])->label('Текст') ?>

    <?= $form->field($model, 'active')->checkbox() ?>

<!--    --><?//= $form->field($model, 'user_photo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
