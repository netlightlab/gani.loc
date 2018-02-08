<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\EditUser */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;



$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = $this->title;
?>

<? //print_r($model) ?>





<h1><?= Html::encode($this->title) ?> : <?= $model->email ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

