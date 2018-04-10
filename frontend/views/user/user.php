<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\Cities;

$cities = new Cities();

$this->title = 'Личный кабинет';

?>
<section class="section-header" style="background: url('../common/img/header/profile.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>ПРИВЕТСТВУЕМ ВАС <?= Yii::$app->user->identity->username ?>!</h2>
                    <p>Это Ваш личный кабинет. Здесь вы можете отслеживать статус своего заказа, просматривать список желаний и менять сведения о себе</p>
                </div>
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
                <div id="cabinet-tab" class="tab-content">
                    <div id="orders" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (is_array($orders) && !empty($orders)): ?>
                                    <?php foreach ($orders as $id => $order): ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Заказ № <?= $id ?></h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p>Сумма заказа: <?= $order['order_info']['sum'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Дата заказа: <?= $order['order_info']['time'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Оплачен: <?= $order['order_info']['paid'] == 0 ? 'Не оплачен' : 'Оплачен' ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h3>У вас нет заказов</h3>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
<!--                                <span style="color: red;">на стадий разработки</span>-->
                                <?php if (is_array($orders) && !empty($orders)): ?>
                                <?php foreach($orders as $id => $order): ?>
                                    <div class="row user-order-list">
                                        <div class="col-12">
                                            <h3>Заказ № <?= $id ?></h3>
                                            <p>Сумма заказа: <?= $order['order_info']['sum'] ?></p>
                                            <p>Дата заказа: <?= $order['order_info']['time'] ?></p>
                                            <p>Оплачен: <?= $order['order_info']['paid'] == 0 ? 'Не оплачен' : 'Оплачен'?></p>
                                        </div>
                                        <div class="col-12">
                                            <?php foreach($order['tours_info'] as $item): ?>
                                                <div class="row py-2">
                                                    <div class="col-md-2">
                                                        <?= Html::img('/common/tour_img/'.$item['tours']['id'].'/'.$item['tours']['mini_image']) ?>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <p><?= $item['tours']['name'] ?></p>
                                                        <? if(!empty($item['tickets'])): ?>
                                                            <p><?= Html::a('Билет', ['/user/ticket', 'id' => $item['tickets']['id']]) ?></p>
                                                        <? endif; ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <p>Билетов:<br /> <?= $item['qty'] ?></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <p>Сумма:<br /> <?= $item['sum'] ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                        <hr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <h2>У вас пока нет заказов</h2>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div id="wishlist" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
<!--                                <span style="color: red;">на стадий разработки</span>-->
                            </div>
                        </div>
                    </div>
                    <div id="settings" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="pb-3">Изменить пароль</h4>
                                <?php $form = ActiveForm::begin(['id' => 'change-password', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                                    <?= $form->field($model, 'password')->label('НОВЫЙ ПАРОЛЬ')->textInput(['required' => 'required', 'type' => 'password']) ?>
                                    <?= $form->field($model, 'repassword')->label('ПОДТВЕРДИТЕ НОВЫЙ ПАРОЛЬ')->textInput(['required' => 'required', 'type' => 'password']) ?>
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
                                <h4 class="pb-3">Профиль</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="profile-info">
                                    <table width="100%;" cellspacing="5" cellpadding="5">
                                        <tr>
                                            <td><strong>Отображаемое имя</strong></td>
                                            <td><span><?= $UsersInfo['username'] ? $UsersInfo['username'] : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Имя</strong></td>
                                            <td><span><?= $UsersInfo['user_name'] ? $UsersInfo['user_name'] : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Фамилия</strong></td>
                                            <td><?= $UsersInfo['surname'] ? $UsersInfo['surname'] : "Не заполнено" ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Номер телефона</strong></td>
                                            <td><span><?= $UsersInfo['phone'] ? $UsersInfo['phone'] : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Дата рождения</strong></td>
                                            <td><span><?= $UsersInfo['bdate'] ? $UsersInfo['bdate'] : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Страна</strong></td>
                                            <td><span><?= $UsersInfo['country'] ? $cities->getCountriesName($UsersInfo['country']) : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Город</strong></td>
                                            <td><span><?= $UsersInfo['city'] ? $UsersInfo['city'] : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Адрес</strong></td>
                                            <td><span><?= $UsersInfo['adres'] ? $UsersInfo['adres'] : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Почтовый индекс</strong></td>
                                            <td><span><?= $UsersInfo['mailindex'] ? $UsersInfo['mailindex'] : "Не заполнено" ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>EMAIL</strong></td>
                                            <td><span><?= $UsersInfo['email'] ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="profile-icon">
                                    <?= $UsersInfo['user_photo'] ? Html::img('@web/common/users/'.$UsersInfo['id'].'/'.$UsersInfo['user_photo']) : Html::img('@web/common/users/no-image.png') ?>
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
                                        <div class="col-md-12">
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
                                            <?= $form->field($model, 'country')->dropDownList($cities->getCountriesList())->label('Страна') ?>
                                        </div>
                                        <div class="col-md-12">
                                            <hr style="margin: 0 !important; width: 100%;">
                                        </div>
                                        <div class="col-md-12 py-3">
                                            <h4>Редактировать информацию</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <?= $form->field($model, 'information')->textarea(['placeholder' => 'Например: Ищу супервыгодные туры', 'rows' => '5'])->label('О себе') ?>
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

