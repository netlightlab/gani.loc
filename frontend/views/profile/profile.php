<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Tabs;

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
                <?= Alert::widget() ?>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5" style="background: #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="cabinet-nav">
                    <li class="cabinet-nav-item"><a class="cabinet-nav-link" href="#"><img src="../common/img/profile/list.png">Заказы</a></li>
                    <li class="cabinet-nav-item"><a class="cabinet-nav-link" href="#"><img src="../common/img/profile/like.png">Список желаний</a></li>
                    <li class="cabinet-nav-item"><a class="cabinet-nav-link" href="#"><img src="../common/img/profile/locked.png">Настройки</a></li>
                    <li class="cabinet-nav-item"><a class="cabinet-nav-link cabinet-btn-active" href="#"><img src="../common/img/profile/user.png">Профиль</a></li>
                </ul>
            </div>
        </div>
        <div class="row pt-4 pb-4" style="background: #fff; border: 1px solid #cccccc; color: #3a3a3a;">
            <div class="col-md-12 pt-3 pb-3">
                <h4>ВАШ ПРОФИЛЬ</h4>
            </div>
            <div class="col-md-8">
                <div class="profile-info">
                    <table width="100%;" cellspacing="5" cellpadding="5">
                        <tr style="background: #f3f3f3;">
                            <td><strong>Отображаемое имя</strong></td>
                            <td><span><?= isset($UsersLogin['username']) ? $UsersLogin['username'] : "Пусто" ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>Имя</strong></td>
                            <td><span><?= isset($UsersInfo) ? $UsersInfo['user_name'] : "Пусто" ?></span></td>
                        </tr>
                        <tr style="background: #f3f3f3;">
                            <td><strong>Фамилия</strong></td>
                            <td><?= isset($UsersInfo['surname']) ? $UsersInfo['surname'] : "Пусто" ?></td>
                        </tr>
                        <tr>
                            <td><strong>Номер телефона</strong></td>
                            <td><span><?= isset($UsersInfo) ? $UsersInfo['phone'] : "Пусто" ?></span></td>
                        </tr>
                        <tr style="background: #f3f3f3;">
                            <td><strong>Дата рождения</strong></td>
                            <td><span><?= isset($UsersInfo['bdate']) ? $UsersInfo['bdate'] : "Пусто" ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>Страна</strong></td>
                            <td><span><?= isset($UsersInfo['country']) ? $UsersInfo['country'] : "Пусто" ?></span></td>
                        </tr>
                        <tr style="background: #f3f3f3;">
                            <td><strong>Город</strong></td>
                            <td><span><?= isset($UsersInfo['city']) ? $UsersInfo['city'] : "Пусто" ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>Адрес</strong></td>
                            <td><span><?= isset($UsersInfo['adres']) ? $UsersInfo['adres'] : "Пусто" ?></span></td>
                        </tr>
                        <tr style="background: #f3f3f3;">
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
<!--                    --><?//= Html::img(Yii::$app->request->baseUrl.'/frontend/images/users/'.$UsersLogin['id'].'/'.$UsersInfo['user_photo']) ?>
<!--                    --><?//= Html::img('frontend/images/header/logo.png'), ['site/index'] ?>
<!--                    --><?//= Html::img(Yii::getAlias('@frontend').'/common/img/header/logo.png'), ['site/index'] ?>
<!--                    <img src="--><?//= __DIR__?><!--/images/users/11/header_fon.jpg" />-->
<!--                    --><?//= Html::a(Html::img('@web/frontend/images/users/11/header_fon.jpg' ), ['site/index']) ?>
                    <span>none</span>
                </div>
            </div>
            <div class="col-md-12 pt-3 pb-3">
                <h4>Личная информация пользователя</h4>
                <span class="profile-more-info"><?= $UsersInfo['information'] ?></span><br>
            </div>
            <div class="col-md-12 pt-3 pb-3">
                <?= Html::a('Изменить данные', ['profile/editprofile'],['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</section>

