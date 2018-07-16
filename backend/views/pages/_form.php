<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.01.2018
 * Time: 11:39
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;
use mihaildev\elfinder\InputFile;
?>

<?php $form = ActiveForm::begin(['id' => 'form-page-create' , 'options' => ['enctype' => 'multipart/form-data']]); ?>


<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">ru</a></li>
    <li><a data-toggle="pill" href="#kz">kz</a></li>
    <li><a data-toggle="pill" href="#en">en</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <?= $form->field($model, 'title')->textInput(['placeholder' => 'Например: О нас'])->label('Название') ?>
        <?= $form->field($model, 'page_title')->textInput(['placeholder' => 'Тайтл']) ?>
        <?= $form->field($model, 'page_description')->textInput(['placeholder' => 'Дескрипшн']) ?>
        <?= $form->field($model, 'page_keywords')->textInput(['placeholder' => 'Кейвордс']) ?>
        <?= $form->field($model, 'content')->widget(CKEditor::class,[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                'preset' => 'full',
//        'path' => 'web/uploads'
                'language' => 'ru'
            ]),
        ]); ?>
    </div>
    <div id="kz" class="tab-pane fade">
        <?= $form->field($model, 'title_kz')->textInput(['placeholder' => 'Например: О нас'])->label('Название kz') ?>
        <?= $form->field($model, 'page_title_kz')->textInput(['placeholder' => 'Тайтл']) ?>
        <?= $form->field($model, 'page_description_kz')->textInput(['placeholder' => 'Дескрипшн']) ?>
        <?= $form->field($model, 'page_keywords_kz')->textInput(['placeholder' => 'Кейвордс']) ?>
        <?= $form->field($model, 'content_kz')->widget(CKEditor::class,[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                'preset' => 'full',
//        'path' => 'web/uploads'
                'language' => 'ru'
            ]),
        ]); ?>
    </div>
    <div id="en" class="tab-pane fade">
        <?= $form->field($model, 'title_en')->textInput(['placeholder' => 'Например: О нас'])->label('Название en') ?>
        <?= $form->field($model, 'page_title_en')->textInput(['placeholder' => 'Тайтл']) ?>
        <?= $form->field($model, 'page_description_en')->textInput(['placeholder' => 'Дескрипшн']) ?>
        <?= $form->field($model, 'page_keywords_en')->textInput(['placeholder' => 'Кейвордс']) ?>
        <?= $form->field($model, 'content_en')->widget(CKEditor::class,[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                'preset' => 'full',
//        'path' => 'web/uploads'
                'language' => 'ru'
            ]),
        ]); ?>
    </div>
</div>



<? if($model->background): ?>
    <!--<img width="200px" src="@web/uploads/pages/2/<?/*= $model->background */?>" alt="">-->
    <?= Html::img('/frontend/web/common/pages/'. $model->id .'/'. $model->background, ['width' => 200]) ?>
<? endif; ?>
<?= $form->field($model, 'background')->fileInput()->label('Изображение') ?>



<?= $form->field($model, 'url')->textInput()->label('ЧПУ') ?>
<?= $form->field($model, 'active')->checkbox() ?>
<?= $form->field($model, 'show')->checkbox() ?>
<?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
