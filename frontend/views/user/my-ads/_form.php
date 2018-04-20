<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.04.2018
 * Time: 11:55
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mihaildev\ckeditor\CKEditor;

?>

<?php $form = ActiveForm::begin(['id' => 'add-tour-rus', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-12">
        <h4>Основная информация</h4>
    </div>
    <div class="col-md-12">
        <hr style="10px 0">
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'phone')->label('телефон (сотовый)')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '9 (999) 999-9999',
        ])->textInput(['placeholder' => 'Например: 8 (777) 777-7777']) ?>
    </div>
    <div class="col-md-4">
        <span class="mb-3 d-flex">Основное изображение</span>
        <?= $form->field($model, 'mini_image')->fileInput()->label('') ?>
    </div>
    <div class="col-md-4">
        <span class="mb-3 d-flex">Галерея фотографии</span>
        <?= $form->field($model, 'gallery')->fileInput()->label('') ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'inline' => false,
                    'preset' => 'standart',
                ],
        ]);?>
    </div>
    <div class="col-md-12">
        <?= Html::submitButton('Разместить объявление', ['class' => 'btn-refresh-profile', 'name' => 'signup-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
