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
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'text')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ]); ?>
        </div>

        <div id="kz" class="tab-pane fade">
            <?= $form->field($model, 'name_kz')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title_kz')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description_kz')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'keywords_kz')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'text_kz')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ]); ?>
        </div>

        <div id="en" class="tab-pane fade">
            <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description_en')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'keywords_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'text_en')->widget(CKEditor::className(),[
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ]); ?>
        </div>
    </div>


    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php if($model->image): ?>
        <?= Html::img('/frontend/web/common/catalog/' . $model->id . '/' . $model->image, [
                'style' => 'width: 150px'
        ]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'recommended')->dropDownList((new \common\models\Categories())->getCategoriesList()) ?>



<!--    --><?//= $form->field($model, 'country_parent')->dropDownList($model->getCountriesList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
