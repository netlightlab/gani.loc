<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\EditProfile */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <? //print_r($asd); ?>

    <p>Регистрация в личном кабинете</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'user_name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'city') ?>

            <?= $form->field($model, 'information') ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
