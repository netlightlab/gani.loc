<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\EditProfile */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Редактирование данных';
$this->params['breadcrumbs'][] = $this->title;

if(isset($model->image) && file_exists(Yii::getAlias('@webroot', $model->image)))
{
    echo Html::img($model->image, ['class'=>'img-responsive']);
    echo $form->field($model,'del_img')->checkBox(['class'=>'span-1']);
}

?>

<div class="site-signup">
    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-12">
            <h3>Редактировать профиль</h3>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'user_name')->textInput(['placeholder' => 'Например: Иван'])->label('Имя') ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'surname')->label('Фамилия')->textInput(['placeholder' => 'Например: Петров']) ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'phone')->label('Номер телефона')->textInput(['placeholder' => 'Например: 8 (707) 693-42-31']) ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'bdate')->label('Дата рождения')->textInput(['placeholder' => 'Например: 17.02.1940']) ?>
        </div>
        <hr style="margin: 0 !important; width: 100%;">
        <div class="col-md-12">
            <h3>Редактировать Адрес</h3>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'adres')->label('Улица')->textInput(['placeholder' => 'Например: Фурманова 35']) ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'city')->label('Город')->textInput(['placeholder' => 'Например: Алматы']) ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'mailindex')->textInput(['placeholder' => 'Например: 99999'])->label('Почтовый индекс') ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'country')->dropDownList([
                'Казахстан',
                'Россия',
            ])->label('Страна') ?>
        </div>
        <hr style="margin: 0 !important; width: 100%;">
        <div class="col-md-12">
            <h3>Редактировать информацию</h3>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'information')->textarea(['rows' => '5'])->textarea(['placeholder' => 'Например: Ищу супервыгодные туры'])->label('О себе') ?>
        </div>
        <hr style="margin: 0 !important; width: 100%;">
        <div class="col-md-12">
            <h3>Загрузить фотографию профиля</h3>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'user_photo')->fileInput()->label('') ?>
        </div>
        <hr style="margin: 0 !important; width: 100%; padding-bottom: 25px;">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <a href="index.php?r=profile%2Findex" class="btn btn-primary">Вернуться назад</a>
                <?= Html::a("Вернуться", ["profile/index"], ["class" => "btn btn-primary", "onclick" => "asdasdas"])?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>