<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;

echo Nav::widget([
    'items' => [
        [
            'label' => 'Мой профиль',
            'items' => [
                [
                    'label' => 'Мои данные',
                    'url' => ['profile/index']
                ],
                '<li class="divider"></li>',
                [
                    'label' => 'Мой счет',
                    'url' => ['#']
                ],
                '<li class="divider"></li>',
                [
                    'label' => 'Статистика',
                    'url' => ['#']
                ]
            ]
        ],
        [
            'label' => 'Мои туры',
            'url' => ['#']
        ]
    ]
]);

?>
<div class="container">
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