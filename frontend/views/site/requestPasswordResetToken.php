<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$this->title = 'Запрос на восстановление пароля';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .pageBg {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .section-header {
        overflow: hidden;
    }
</style>

<section class="section-header" style="">
        <?= Html::img('/frontend/web/common/img/header/ms.jpg', ['class' => 'pageBg']) ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2><?= $this->title ?></h2>
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

<section class="container py-5">
    <div class="site-request-password-reset">

        <p>Пожалуйста, введите свой email, туда будет направлено сообщение о восстановлении пароля.</p>

        <div class="row">
            <div class="col-md-12">
                <?= Alert::widget() ?>
            </div>
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
