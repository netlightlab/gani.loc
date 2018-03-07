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
?>




<?php $form = ActiveForm::begin(['id' => 'form-page-create' , 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->textInput(['placeholder' => 'Например: О нас'])->label('Название') ?>
<? if($model->background): ?>
    <!--<img width="200px" src="@web/uploads/pages/2/<?/*= $model->background */?>" alt="">-->
    <?= Html::img('/frontend/web/common/pages/'. $model->id .'/'. $model->background, ['width' => 200]) ?>
<? endif; ?>
<?= $form->field($model, 'background')->fileInput()->label('Изображение') ?>
<?= $form->field($model, 'content')->widget(CKEditor::className(),[
    'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
        'preset' => 'full'
    ]),
]); ?>
<?= $form->field($model, 'url')->textInput()->label('ЧПУ') ?>
<?= $form->field($model, 'active')->checkbox() ?>
<?= $form->field($model, 'show')->checkbox() ?>
<?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
