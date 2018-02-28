<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\EditUser */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use common\models\Cities;
use common\models\Countries;

$cities = new Cities();
$countries = new Countries();

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?> : <?= $model->email ?></h1>

<?= $this->render('_form_'.$role, [
    'model' => $model,
    'tours' => $tours,
    'countries' => $countries,
    'cities' => $cities
]) ?>

