<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.01.2018
 * Time: 12:47
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\Cities;
use common\models\Countries;

?>

<? //print_r($model) ?>

<section class="pt-5 pb-5" style="background: #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= Alert::widget() ?>
                <ul id="w1" class="cabinet-nav nav nav-tabs">
                    <li class="nav-item"><a class="nav-link" href="#statistics" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/stats.png"><span>Статистика</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#orders" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/list.png"><span>Заказы</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#my_tours" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/tours.png"><span>Мои туры/развлечения</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/locked.png"><span>Настройки</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/user.png"><span>Профиль</span></a></li>
                </ul>
                <div class="tab-content">
                    <div id="statistics" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="color: red;">на стадий разработки</span>
                            </div>
                        </div>
                    </div>
                    <div id="orders" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="color: red;">на стадий разработки</span>
                            </div>
                        </div>
                    </div>
                    <div id="my_tours" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?/*= Html::a('Добавить тур', ['my-tours/add'], ['class' => 'btn-refresh-profile', 'style' => 'text-decoration: none !important; display: block;']) */?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h3>Список ваших туров/развлечений</h3>
                                <hr>
                            </div>
                            <?php foreach ($tours as $tour):?>
                                <div id="tour" class="col-md-4 col-sm-6 my-3">
                                    <a href="/admin/tours/update?id=<?= $tour->id ?>" title="<?= $tour->name ?>">
                                        <div class="boxTour-hit">
                                            <div class="tour-img">
                                                <?= Html::img('@web/common/tour_img/'.$tour->id.'/'.$tour->mini_image) ?>
                                                <div class="tour-info">
                                                    <span><span style="font-weight:normal; font-size: 16px;">от</span> <?= $tour->price ?> <span style="font-weight:normal; font-size: 16px;">тг</span></span>
                                                    <p>подробнее</p>
                                                    <h4>Category</h4>
                                                </div>
                                            </div>
                                            <h5><?= $tour->name ?></h5>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div id="settings" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="pb-3">Изменить пароль</h4>
                                <?php /*$form = ActiveForm::begin(['id' => 'change-password', 'options' => ['enctype' => 'multipart/form-data']]); */?><!--
                                <?/*= $form->field($model, 'password')->label('НОВЫЙ ПАРОЛЬ')->textInput(['required' => 'required', 'type' => 'password']) */?>
                                <?/*= $form->field($model, 'repassword')->label('ПОДТВЕРДИТЕ НОВЫЙ ПАРОЛЬ')->textInput(['required' => 'required', 'type' => 'password']) */?>
                                <?/*= Html::submitButton('Обновить пароль', ['class' => 'btn-refresh-profile', 'name' => 'signup-edit']) */?>
                                --><?php /*ActiveForm::end(); */?>
                            </div>
                            <div class="col-md-6">
                                <h4 class="pb-3">Изменить пароль</h4>
                                <?php $form = ActiveForm::begin(['id' => 'change-password', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                                <?= $form->field($model, 'password')->label('НОВЫЙ ПАРОЛЬ')->textInput(['required' => 'required', 'type' => 'password']) ?>
                                <?/*= $form->field($model, 'repassword')->label('ПОДТВЕРДИТЕ НОВЫЙ ПАРОЛЬ')->textInput(['required' => 'required', 'type' => 'password']) */?>
                                <?= Html::submitButton('Обновить пароль', ['class' => 'btn-refresh-profile', 'name' => 'signup-edit']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                            <div class="col-md-6">
                                <h4 class="pb-3">Изменить email адрес</h4>
                                <?php $form = ActiveForm::begin(['id' => 'change-email', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                                <?= $form->field($model, 'email')->label('НОВЫЙ EMAIL')->textInput(['value' => '', 'required' => 'required', 'type' => 'email']) ?>
                                <?= $form->field($model, 'confemail')->label('ПОДТВЕРДИТЕ НОВЫЙ EMAIL')->textInput(['value' => '', 'required' => 'required', 'type' => 'email']) ?>
                                <?= Html::submitButton('Обновить email', ['class' => 'btn-refresh-profile', 'name' => 'change-email']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    <div id="profile" class="tab-pane set-tab-content active">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="pb-3">Профиль компании</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="profile-info">
                                    <table width="100%;" cellspacing="5" cellpadding="5">
                                        <tr>
                                            <td><strong>Название компании</strong></td>
                                            <td><span><?= $model->name_company ? $model->name_company : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Бренд</strong></td>
                                            <td><span><?= $model->name_brand ? $model->name_brand : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Страна</strong></td>
                                            <td><?= $model->country ? $cities->getCountriesName($model->country) : "Не заполнено" ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Город</strong></td>
                                            <td><span><?= $model->city ? $model->city : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Адрес компании</strong></td>
                                            <td><span><?= $model->street ? $model->street : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Дополнительные сведения об адресе</strong></td>
                                            <td><span><?= $model->additional_street ?$model->additional_street : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Почтовый индекс</strong></td>
                                            <td><span><?= $model->mailindex ? $model->mailindex : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Контактное лицо</strong></td>
                                            <!--<td><span><?/*= $model->fio ? $model->fio : "Не заполнено" */?></span></td>-->
                                        </tr>
                                        <tr>
                                            <td><strong>Должность</strong></td>
                                            <td><span><?= $model->position_company ? $model->position_company : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Вебсайт</strong></td>
                                            <td><span><?= $model->website ? $model->website : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Номер телефона (сот)</strong></td>
                                            <td><span><?= $model->mobile_phone_1 ? $model->mobile_phone_1 : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Номер телефона (гор)</strong></td>
                                            <td><span><?= $model->city_phone_1 ? $model->city_phone_1 : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td><span><?= $model->email?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="profile-icon">
                                    <?= $model->user_photo ? Html::img('@web/common/users/'.$model->id.'/'.$model->user_photo) : Html::img('@web/common/users/no-image.png') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="py-3">Информация о компании</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="profile-more-info"><?= $model->about_company ?></span><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span style="cursor: pointer; width: auto;" class="btn-refresh-profile" onclick="$('#profile_form').toggle();">Изменить данные</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr style="margin-top: 30px !important; width: 100%;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                                <div id="profile_form" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12 pb-3">
                                            <h4>Изменить основную информацию</h4>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <?= $form->field($model, 'name_company')->textInput(['placeholder' => 'Например: TOO el-tourism'])->label('ОФИЦИАЛЬНОЕ НАЗВАНИЕ КОМПАНИИ*') ?>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <?= $form->field($model, 'name_brand')->label('НАЗВАНИЕ БРЕНДА*')->textInput(['placeholder' => 'Например: el-tour']) ?>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <?= $form->field($model, 'country')->dropDownList($cities->getCountriesList())->label('СТРАНА*') ?>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <?= $form->field($model, 'city')->dropDownList($cities->getCountriesList())->label('ГОРОД*') ?>
                                        </div>
                                        <div class="col-md-12">
                                            <?= $form->field($model, 'about_company')->textarea(['placeholder' => 'Например: TOO Kolsaylakes', 'rows' => '10'])->label('ОПИСАНИЕ КОМПАНИИ') ?>
                                        </div>
                                        <div class="col-md-12">
                                            <hr style="width: 100%;">
                                        </div>
                                        <div class="col-md-12 py-3">
                                            <h4>Изменить адрес компании</h4>
                                        </div>
                                        <div class="col-md-4 col-xs-6">
                                            <?= $form->field($model, 'street')->label('УЛИЦА')->textInput(['placeholder' => 'Например: Фурманова 35']) ?>
                                        </div>
                                        <div class="col-md-4 col-xs-6">
                                            <?= $form->field($model, 'additional_street')->label('ДОПОЛНИТЕЛЬНЫЕ СВЕДЕНИЕ ОБ АДРЕСЕ')->textInput(['placeholder' => 'Например: Алматы']) ?>
                                        </div>
                                        <div class="col-md-4 col-xs-6">
                                            <?= $form->field($model, 'mailindex')->textInput(['placeholder' => 'Например: 99999'])->label('ПОЧТОВЫЙ ИНДЕКС') ?>
                                        </div>
                                        <div class="col-md-12">
                                            <hr style="width: 100%;">
                                        </div>
                                        <div class="col-md-12 py-3">
                                            <h4>Изменить контактную информацию</h4>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'user_name')->textInput(['placeholder' => 'Например: Иван Иванович Иванов'])->label('КОНТАКТНОЕ ЛИЦО') ?>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'surname')->textInput(['placeholder' => 'Например: Иван Иванович Иванов'])->label('КОНТАКТНОЕ ЛИЦО') ?>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'position_company')->textInput(['placeholder' => 'Например: Директор'])->label('ДОЛЖНОСТЬ') ?>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'website')->textInput(['placeholder' => 'Например: el-tour.kz'])->label('ВЕБ-САЙТ') ?>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'mobile_phone_1')->label('телефон (сотовый)')->widget(\yii\widgets\MaskedInput::className(), [
                                                'mask' => '9 (999) 999-9999',
                                            ])->textInput(['placeholder' => 'Например: 8 (777) 777-7777']) ?>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'mobile_phone_2')->label('телефон (сотовый)')->widget(\yii\widgets\MaskedInput::className(), [
                                                'mask' => '9 (999) 999-9999',
                                            ])->textInput(['placeholder' => 'Например: 8 (777) 777-7777']) ?>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'mobile_phone_3')->label('телефон (сотовый)')->widget(\yii\widgets\MaskedInput::className(), [
                                                'mask' => '9 (999) 999-9999',
                                            ])->textInput(['placeholder' => 'Например: 8 (777) 777-7777']) ?>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'city_phone_1')->label('телефон (городской)')->widget(\yii\widgets\MaskedInput::className(), [
                                                'mask' => '999 (999) 99-99',
                                            ])->textInput(['placeholder' => 'Например: 727 (232) 77-77']) ?>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <?= $form->field($model, 'city_phone_2')->label('телефон (городской)')->widget(\yii\widgets\MaskedInput::className(), [
                                                'mask' => '999 (999) 99-99',
                                            ])->textInput(['placeholder' => 'Например: 727 (232) 77-77']) ?>
                                        </div>
                                        <div class="col-md-12">
                                            <hr style="width: 100%;">
                                        </div>
                                        <div class="col-md-12 py-3">
                                            <h4>Загрузить фотографию профиля</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <?= $form->field($model, 'user_photo')->fileInput()->label('') ?>
                                            <hr style="width: 100%; padding-bottom: 25px;">
                                        </div>
                                        <div class="col-md-12 py-3">
                                            <h4>Активирован</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <?= $form->field($model, 'active')->checkbox(['label' => 'Учетная запись активна',]) ?>
                                            <hr style="width: 100%; padding-bottom: 25px;">

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?= Html::submitButton('Обновить профиль', ['class' => 'btn-refresh-profile', 'name' => 'signup-button']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
