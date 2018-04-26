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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?php if($model->image): ?>
        <?= Html::img('/frontend/web/common/catalog/' . $model->id . '/' . $model->image, [
                'style' => 'width: 150px'
        ]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'recommended')->dropDownList((new \common\models\Categories())->getCategoriesList()) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full'
        ]),
    ]); ?>

<!--    --><?//= $form->field($model, 'country_parent')->dropDownList($model->getCountriesList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
