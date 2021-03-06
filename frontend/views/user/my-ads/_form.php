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

<?php $form = ActiveForm::begin([
        'id'                     => 'ads-add',
//        'enableAjaxValidation' => true,
//        'enableClientValidation' => false,
        'options' => [
                'enctype'   => 'multipart/form-data',
                'class'     => 'ads-form'
        ]]
); ?>
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
        <?= $form->field($model, 'mini_image')->fileInput(['autoComplete' => 'off', 'id' => 'mini_image'])->label('') ?>
    </div>
    <div class="col-md-12">
        <? print_r($gallery) ?>
        <span class="mb-3 d-flex">Галерея фотографии</span>
        <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    </div>
    <div class="col-md-12 my-3">
        <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'inline' => false,
                    'preset' => 'standart',
                ],
        ])->label('ОПИСАНИЕ*');?>
    </div>
    <div class="col-md-12">
        <?= Html::submitButton('Разместить объявление', ['class' => 'btn-refresh-profile']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php
$script = <<<JS
    
JS;

$this->registerJs($script);

?>
