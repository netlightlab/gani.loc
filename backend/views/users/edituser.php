<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.11.2017
 * Time: 18:22
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <? print_r($user) ?>
            <? print_r($role) ?>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>



            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
