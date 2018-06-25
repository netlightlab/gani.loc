<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ads-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true])->label('Описание') ?>

    <?= $form->field($model, 'description_en')->textarea(['maxlength' => true])->label('Описание на английском') ?>

<!--    --><?//= $form->field($model, 'mini_image')->textInput(['maxlength' => true])->label('Изображение') ?>
    <p><strong>Изображение</strong></p>
    <? if(!empty($model->mini_image)): ?>
        <?= Html::img('/frontend/web/common/users/'.$model->user_id.'/ads/'.$model->mini_image, [
            'style' => [
                'width' => '150px'
            ]
        ]) ?>
    <? endif; ?>

<!--    --><?//= $form->field($model, 'gallery')->textInput(['maxlength' => true])->label('Галерея') ?>
    <p><strong>Галерея</strong></p>
    <? if(!empty($model->gallery)): ?>
        <? foreach(unserialize($model->gallery) as $item): ?>
            <?= Html::img('/frontend/web/common/users/'.$model->user_id.'/ads/'.$item, [
                    'style' => [
                            'width' => '150px'
                    ]
            ]) ?>
        <? endforeach; ?>
    <? endif; ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
