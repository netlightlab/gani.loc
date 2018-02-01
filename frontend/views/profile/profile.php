<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;

$this->title = 'Личный кабинет';

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
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5" style="background: #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= Alert::widget() ?>
                <ul id="w1" class="cabinet-nav nav nav-tabs">
                    <li class="nav-item"><a class="nav-link" href="#orders" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/list.png"><span>Заказы</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#wishlist" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/like.png"><span>Список желаний</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/locked.png"><span>Настройки</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/user.png"><span>Профиль</span></a></li>
                </ul>
                <div class="tab-content">
                    <div id="orders" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="color: red;">на стадий разработки</span>
                            </div>
                        </div>
                    </div>
                    <div id="wishlist" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="color: red;">на стадий разработки</span>
                            </div>
                        </div>
                    </div>
                    <div id="settings" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="color: red;">на стадий разработки</span>
                            </div>
                        </div>
                    </div>
                    <div id="profile" class="tab-pane set-tab-content active">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="pb-3">Профиль</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="profile-info">
                                    <table width="100%;" cellspacing="5" cellpadding="5">
                                        <tr>
                                            <td><strong>Отображаемое имя</strong></td>
                                            <td><span><?= isset($UsersLogin['username']) ? $UsersLogin['username'] : "Пусто" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Имя</strong></td>
                                            <td><span><?= isset($UsersInfo) ? $UsersInfo['user_name'] : "Пусто" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Фамилия</strong></td>
                                            <td><?= isset($UsersInfo['surname']) ? $UsersInfo['surname'] : "Пусто" ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Номер телефона</strong></td>
                                            <td><span><?= isset($UsersInfo) ? $UsersInfo['phone'] : "Пусто" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Дата рождения</strong></td>
                                            <td><span><?= isset($UsersInfo['bdate']) ? $UsersInfo['bdate'] : "Пусто" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Страна</strong></td>
                                            <td><span><?= isset($UsersInfo['country']) ? $UsersInfo['country'] : "Пусто" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Город</strong></td>
                                            <td><span><?= isset($UsersInfo['city']) ? $UsersInfo['city'] : "Пусто" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Адрес</strong></td>
                                            <td><span><?= isset($UsersInfo['adres']) ? $UsersInfo['adres'] : "Пусто" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Почтовый индекс</strong></td>
                                            <td><span><?= isset($UsersInfo['mailindex']) ? $UsersInfo['mailindex'] : "Пусто" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>EMAIL</strong></td>
                                            <td><span><?= $UsersLogin['email'] ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="profile-icon">
                                    <?= isset($UsersInfo['user_photo']) ? Html::img('@web/common/users/'.$UsersInfo['id'].'/'.$UsersInfo['user_photo']) : Html::img('@web/common/users/no-image.png') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="py-3">Личная информация пользователя</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="profile-more-info"><?= $UsersInfo['information'] ?></span><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span style="cursor: pointer; width: auto;" class="btn-refresh-profile" onclick="$('#profile_form').toggle();">Изменить данные</span>
                            </div>
                        </div>
                            <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                                <div id="profile_form" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12 pb-3">
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
                                            <hr style="margin: 0 !important; width: 100%;">
                                        </div>
                                        <div class="col-md-12 py-3">
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
                                            <hr style="margin: 0 !important; width: 100%;">
                                        </div>
                                        <div class="col-md-12 py-3">
                                            <h4>Редактировать информацию</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <?= $form->field($model, 'information')->textarea(['rows' => '5'])->textarea(['placeholder' => 'Например: Ищу супервыгодные туры'])->label('О себе') ?>
                                            <hr style="margin: 0 !important; width: 100%;">
                                        </div>
                                        <div class="col-md-12 py-3">
                                            <h4>Загрузить фотографию профиля</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <?= $form->field($model, 'user_photo')->fileInput()->label('') ?>
                                            <hr style="margin: 0 !important; width: 100%; padding-bottom: 25px;">
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

