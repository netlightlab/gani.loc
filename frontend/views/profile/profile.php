<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$this->title = 'Личный кабинет';

?>
<section class="section-header" style="background: url('../common/img/header/profile.jpg')">
    <h2 class="pt-5 pb-2" style="color: #fff" align="center">Приветствуем вас <span style="color: orange; font-size: 3rem;"><?= Yii::$app->user->identity->username ?></span> на нашем сайте!</h2>
    <h5 class="pb-5" style="color: #fff" align="center">Это Ваш личный кабинет. Здесь вы можете отслеживать статус своего заказа, просматривать список желаний и менять сведения о себе</h5>
</section>

<div class="container-fluid m-0 p-0">
    <div class="row p-0 m-0">
        <div class="col-md-12 p-0 m-0">
            <?php $this->params['breadcrumbs'][] = $this->title; ?>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
        </div>
    </div>
    <div class="row m-0 p-0">
        <div class="col-md-2 p-0 m-0 left-menu-lk" style="background: #2e2e2e; border-bottom: 2px solid white;">
            <ul class="left-menu mr-auto">
                <li class="left-nav-item active">
                    <a href="#" class="left-nav-link">Профлиь</a>
                </li>
                <li class="left-nav-item">
                    <a href="#" class="left-nav-link">Заказы</a>
                </li>
                <li class="left-nav-item">
                    <a href="#" class="left-nav-link">Список желаний</a>
                </li>
                <li class="left-nav-item">
                    <a href="#" class="left-nav-link">Понравившиеся</a>
                </li>
                <li class="left-nav-item">
                    <a href="#" class="left-nav-link">Статистика</a>
                </li>
                <li class="left-nav-item">
                    <a href="#" class="left-nav-link">Выход</a>
                </li>
            </ul>
        </div>
        <div class="col-md-10 p-3" style="background: #ffffff;">
            <div class="row">
                <div class="col-md-12">
                    <h3>ВАШ ПРОФИЛЬ</h3>
                </div>
                <div class="col-md-8">
                    <table width="100%;" cellspacing="5" cellpadding="5" style="    background: #fdfbfb;
    border: 1px solid #f3f3f3;
    margin-bottom: 15px;">
                        <tr style="background: #f3f3f3;">
                            <td style="padding: 5px;"><strong>Имя пользователя</strong></td>
                            <td style="padding: 5px;"><span><?= isset($UsersLogin['username']) ? $UsersLogin['username'] : "Пусто" ?></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;"><strong>Имя</strong></td>
                            <td style="padding: 5px;"><span><?= isset($UsersInfo) ? $UsersInfo['user_name'] : "Пусто" ?></span></td>
                        </tr>
                        <tr style="background: #f3f3f3;">
                            <td style="padding: 5px;"><strong>Фамилия</strong></td>
                            <td style="padding: 5px;"><?= isset($UsersInfo['surname']) ? $UsersInfo['surname'] : "Пусто" ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;"><strong>Номер телефона</strong></td>
                            <td style="padding: 5px;"><span><?= isset($UsersInfo) ? $UsersInfo['phone'] : "Пусто" ?></span></td>
                        </tr>
                        <tr style="background: #f3f3f3;">
                            <td style="padding: 5px;"><strong>Дата рождения</strong></td>
                            <td style="padding: 5px;"><span><?= isset($UsersInfo['bdate']) ? $UsersInfo['bdate'] : "Пусто" ?></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;"><strong>Страна</strong></td>
                            <td style="padding: 5px;"><span><?= isset($UsersInfo['country']) ? $UsersInfo['country'] : "Пусто" ?></span></td>
                        </tr>
                        <tr style="background: #f3f3f3;">
                            <td style="padding: 5px;"><strong>Город</strong></td>
                            <td style="padding: 5px;"><span><?= isset($UsersInfo['city']) ? $UsersInfo['city'] : "Пусто" ?></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;"><strong>Адрес</strong></td>
                            <td style="padding: 5px;"><span><?= isset($UsersInfo['adres']) ? $UsersInfo['adres'] : "Пусто" ?></span></td>
                        </tr>
                        <tr style="background: #f3f3f3;">
                            <td style="padding: 5px;"><strong>Почтовый индекс</strong></td>
                            <td style="padding: 5px;"><span><?= isset($UsersInfo['mailindex']) ? $UsersInfo['mailindex'] : "Пусто" ?></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;"><strong>EMAIL</strong></td>
                            <td style="padding: 5px;"><span><?= $UsersLogin['email'] ?></span></td>
                        </tr>
                    </table>
                    <a href="index.php?r=profile%2Feditprofile" class="btn btn-primary">Изменить данные</a>
                </div>
                <div class="col-md-4" style="border: 1px solid #f1f0f0; padding: 10px; text-align: center;">
                    <img src="../images/users/<?= $UsersLogin['id'] ?>/<?= $UsersInfo['user_photo']?>" alt="" style="    min-width: 265px;
    max-width: 300px;
    width: 100%;
    min-height: 280px;
    max-height: 280px;
    height: 100%;" />
                </div>
                <div class="col-md-12">
                    <h3>ИНФОРМАЦИЯ ПОЛЬЗОВАТЕЛЯ</h3>
                    <span><?= $UsersInfo['information'] ?></span><br>
                </div>
            </div>
        </div>
    </div>
</div>
