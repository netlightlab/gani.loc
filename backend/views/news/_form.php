<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model common\models\Catalog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

    <?php $form = ActiveForm::begin(['class' => 'catalog_form' , 'options' => ['enctype' => 'multipart/form-data']]); ?>



    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#home">ru</a></li>
        <li><a data-toggle="pill" href="#kz">kz</a></li>
        <li><a data-toggle="pill" href="#en">en</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'page_title')->textInput(['placeholder' => 'Тайтл']) ?>
            <?= $form->field($model, 'page_description')->textInput(['placeholder' => 'Дескрипшн']) ?>
            <?= $form->field($model, 'page_keywords')->textInput(['placeholder' => 'Кейвордс']) ?>
            <?= $form->field($model, 'description')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ]); ?>
        </div>
        <div id="kz" class="tab-pane fade">
            <?= $form->field($model, 'title_kz')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'page_title_kz')->textInput(['placeholder' => 'Тайтл']) ?>
            <?= $form->field($model, 'page_description_kz')->textInput(['placeholder' => 'Дескрипшн']) ?>
            <?= $form->field($model, 'page_keywords_kz')->textInput(['placeholder' => 'Кейвордс']) ?>
            <?= $form->field($model, 'description_kz')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ]); ?>
        </div>
        <div id="en" class="tab-pane fade">
            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'page_title_en')->textInput(['placeholder' => 'Тайтл']) ?>
            <?= $form->field($model, 'page_description_en')->textInput(['placeholder' => 'Дескрипшн']) ?>
            <?= $form->field($model, 'page_keywords_en')->textInput(['placeholder' => 'Кейвордс']) ?>
            <?= $form->field($model, 'description_en')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true, 'type' => 'date']) ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php if($model->image): ?>
        <?= Html::img('/frontend/web/common/catalog/' . $model->id . '/' . $model->image, [
            'style' => 'width: 150px'
        ]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'image')->fileInput() ?>


    <!--    --><?//= $form->field($model, 'country_parent')->dropDownList($model->getCountriesList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
