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
        <?= $form->field($model, 'mini_image')->fileInput()->label('') ?>
    </div>
    <div class="col-md-12">
        <span class="mb-3 d-flex">Галерея фотографии</span>
        <?php
        echo \kato\DropZone::widget([
            'options' => [
                'maxFilesize' => 10,
                'maxFiles' => 100,
                'url' => $_SERVER['REQUEST_URI'].'/',
                'uploadMultiple' => true,
                'parallelUploads' => 10,
                'autoProcessQueue' => false,
            ],
            'clientEvents' => [
                'removedfile' => "function(file){alert(file.name + ' is removed')}"
            ],
        ]);
        ?>
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
        <?= Html::submitButton('Разместить объявление', ['class' => 'btn-refresh-profile', 'name' => 'signup-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php
$script = <<<JS

    $("#ads-add").on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        var photos = [];
        $.each(myDropzone.files, function(index, value) {
          photos.push(value.name);
        }) ;
        form += "&Ads%5Bgallery%5D="+photos;
        $.ajax({
            type: 'POST',            
            data: form,
            succes: function(response) {
                console.log(response);
            },
            error: function(error) {
              console.log(error)
            }
          }).done(function(){
            myDropzone.processQueue();
            // window.location.href = '/user/index';
          });
        return false;
    });
JS;

$this->registerJs($script);

?>
