<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\EditProfile */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use yii\bootstrap\ActiveForm;

$this->title = 'Редактирование данных';

if(isset($model->image) && file_exists(Yii::getAlias('@webroot', $model->image)))
{
    echo Html::img($model->image, ['class'=>'img-responsive']);
    echo $form->field($model,'del_img')->checkBox(['class'=>'span-1']);
}

?>

<section class="section-header" style="background: url('../common/img/header/profile.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="pt-5 pb-2" style="color: #fff" align="center">Приветствуем вас <span style="color: orange; font-size: 3rem;"><?= Yii::$app->user->identity->username ?></span> на нашем сайте!</h2>
                <h5 class="pb-5" style="color: #fff;     text-shadow: 0px 6px 3px #6f6f6f;" align="center">Это Ваш личный кабинет. Здесь вы можете отслеживать статус своего заказа, просматривать список желаний и менять сведения о себе</h5>
            </div>
        </div>
    </div>
</section>

<section style="background: #2e2e2e;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $this->params['breadcrumbs'][] = $this->title; ?>
                <?= Breadcrumbs::widget([
//                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'links' => [
                        [
                            'label' => 'Личный кабинет',
                            'url' => ['profile/index'],
                        ],
                        //['label' => 'Sample Post', 'url' => ['post/edit', 'id' => 1]],
                        'Редактирование данных',
                    ],
                ]) ?>

                <?= Alert::widget() ?>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5" style="background: #f9f9f9; border: 1px solid #ccc">
    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="container" style="background: #fff; border: 1px solid #ccc;">
        <div class="row">
            <div class="col-md-12">
                <h4>Редактировать профиль</h4>
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
                <h4>Редактировать Адрес</h4>
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
                <h4>Редактировать информацию</h4>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'information')->textarea(['rows' => '5'])->textarea(['placeholder' => 'Например: Ищу супервыгодные туры'])->label('О себе') ?>
            </div>
            <hr style="margin: 0 !important; width: 100%;">
            <div class="col-md-12">
                <h4>Загрузить фотографию профиля</h4>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'user_photo')->fileInput()->label('') ?>
            </div>
            <hr style="margin: 0 !important; width: 100%; padding-bottom: 25px;">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <?= Html::a("Вернуться назад", ["profile/index"], ["class" => "btn btn-primary"])?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</section>