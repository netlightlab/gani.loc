<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\Cities;
use mihaildev\ckeditor\CKEditor;

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
                    <li class="nav-item"><a class="nav-link" href="#ads" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/like.png"><span>Мои объявления</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/locked.png"><span>Настройки</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab" aria-expanded="true"><img src="../common/img/profile/user.png"><span>Профиль</span></a></li>
                </ul>
                <div id="cabinet-tab" class="tab-content">
                    <div id="orders" class="tab-pane set-tab-content">
                        <div class="row">
                            <?php if (is_array($orders) && !empty($orders)): ?>
                                <?php foreach ($orders as $id => $order): ?>
                                    <div id="order_[<?= $id ?>]" class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="order_number">Заказ № <span><?= $id ?></span></h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="order_info">
                                                    <div class="order_info-header">
                                                        <span>Сумма заказа:</span>
                                                    </div>
                                                    <div class="order_info-body">
                                                        <span><?= Html::img('@web/common/img/order/money.png') ?> <?= $order['order_info']['sum'] ?> тг.</span>
                                                    </div>
                                                    <div class="order_info-footer">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="order_info">
                                                    <div class="order_info-header">
                                                        <span>Дата заказа:</span>
                                                    </div>
                                                    <div class="order_info-body">
                                                        <span><?= Html::img('@web/common/img/order/calendar.png') ?> <?= $order['order_info']['time'] ?></span>
                                                    </div>
                                                    <div class="order_info-footer">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="order_info">
                                                    <div class="order_info-header">
                                                        <span>Статус оплаты:</span>
                                                    </div>
                                                    <div class="order_info-body">
                                                        <span><?= $order['order_info']['paid'] == 0 ? Html::img('@web/common/img/order/fail.png').'Не оплачен' : Html::img('@web/common/img/order/ok.png').'Оплачен' ?></span>
                                                    </div>
                                                    <div class="order_info-footer">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="order_list-tour">Список туров:</h4>
                                                <hr>
                                            </div>
                                        </div>
                                        <?php foreach($order['tours_info'] as $item): ?>
                                            <div class="order_tour">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="order_tour-img">
                                                            <?= Html::img('/common/tour_img/'.$item['tours']['id'].'/'.$item['tours']['mini_image']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="order_tour-description">
                                                            <p><?= $item['tours']['name'] ?></p>
                                                            <? if(!empty($item['tickets'])): ?>
                                                                <p><?= Html::a('Билет', ['/user/ticket', 'id' => $item['tickets']['id']]) ?></p>
                                                            <? endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="order_tour-tickets">
                                                            <p>Кол-во билетов:</p>
                                                            <small><?= $item['qty'] ?> шт.</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="order_tour-money">
                                                            <p>Сумма:</p>
                                                            <small><?= $item['sum'] ?> тг.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <hr class="order_space">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-md-12">
                                    <h3>У вас нет заказов</h3>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="ads" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?= Html::a('Разместить объявление', ['user/ads-create'], ['class' => 'btn-refresh-profile']) ?>
                                <?= Html::a('правила подачи объявления', ['./site/page', 'id' => 6], ['class' => 'alltours_btn-info mt-3', 'target' => 'blank', 'style' => 'cursor: pointer; border: none; width: 240px;']) ?>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <h3>Мои объявления</h3>
                                <hr>
                            </div>
                            <?= $this->render('_ads', [
                                'ads' => $ads,
                            ]) ?>
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
                                            <td><span><?= $UsersInfo['city'] ? $cities->getCitiesName($UsersInfo['city']) : "Не заполнено" ?></span></td>
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
                                            <?= $form->field($model, 'phone')->label('Номер телефона')->widget(\yii\widgets\MaskedInput::className(), [
                                                'mask' => '9 (999) 999-9999',
                                            ])->textInput(['placeholder' => 'Например: 8 (777) 777-7777']) ?>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <?= $form->field($model, 'bdate')->label('Дата рождения')->textInput(['type' => 'date', 'placeholder' => 'Например: 17.02.1940']) ?>
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
                                            <?= $form->field($model, 'country')->dropDownList($cities->getCountriesList(), ['id' => 'CountryId'])->label('СТРАНА*') ?>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <?= $form->field($model, 'mailindex')->textInput(['placeholder' => 'Например: 99999'])->label('Почтовый индекс') ?>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <?= $form->field($model, 'city')->dropDownList($cities->getCitiesList($UsersInfo['country']), ['id' => 'CitiesList'])->label('ГОРОД*') ?>
                                        </div>
                                        <div class="col-md-12">
                                            <hr style="margin: 0 !important; width: 100%;">
                                        </div>
                                        <div class="col-md-12 py-3">
                                            <h4>Редактировать информацию</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <?= $form->field($model, 'information')->widget(CKEditor::className(), [
                                                'editorOptions' => [
                                                    'inline' => false,
                                                    'preset' => 'standart',
                                                ],
                                            ])->label('О себе');?>
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

<?php
$script = <<<JS
    $('#CountryId').change(function() {        
        $.ajax({
            'url'       : '/user/index',
            'method'    : 'post',
            'data'      : {'country_id': this.value},
            'dataType'  : 'json',
            'success'   : function(data) {
                var options = [];
                for (var value in data) {
                    if (data.hasOwnProperty(value)) {
                        options.push('value="' + value + '">' + data[value]);
                    }
                }
                document.getElementById('CitiesList').innerHTML = '<option ' + options.join('</option><option ') + '</option>';
            },
        });
    });
JS;

$this->registerJs($script);

?>