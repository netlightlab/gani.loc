<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\models\Menu;

AppAsset::register($this);
$context = $this->context;

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<header class="">
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-xs-2 pb-2 d-flex align-items-center">
                    <a href="#"><?= Html::a(Html::img('@web/common/img/footer/vk.png', ['width' => '26px'] ), ['site/index'], ['class' => 'mr-1 ml-1']) ?></a>
                    <a href="#"><?= Html::a(Html::img('@web/common/img/footer/face.png', ['width' => '26px'] ), ['site/index'], ['class' => 'mr-1 ml-1']) ?></a>
                    <a href="#"><?= Html::a(Html::img('@web/common/img/footer/mail.png', ['width' => '26px'] ), ['site/index'], ['class' => 'mr-1 ml-1']) ?></a>
                </div>
                <div class="col-md-10 pb-2 top_line-box">
                    <ul class="profile-menu d-flex justify-content-center align-items-center">
                        <li class="profile-button">
                            <?php
                            if (Yii::$app->user->isGuest) {
                                echo Html::a("Войти", ["site/login"], ["class" => "nav-link"]).Html::img('common/img/header/enter_profile.png');
                            } else {
                                echo Menu::showCab();
                            }
                            ?>
                        </li>
                        <li class="profile-button">
                            <?php
                            if (Yii::$app->user->isGuest) {
                                echo Html::a("Регистрация", ["site/signup"], ["class" => "nav-link"]).Html::img('common/img/header/register_profile.png');
                            } else {
                                echo
                                    Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'ВЫЙТИ',
                                        ['class' => 'nav-link exit-account']
                                    )
                                    . Html::endForm();
                            }
                            ?>
                        </li>
                       <!-- <li class="profile-button">
                            <select class="top_line-currency">
                                <option selected>₸ KZT</option>
                                <option>ք RUB</option>
                                <option>€ EUR</option>
                                <option>$ USD</option>
                            </select>
                        </li>-->
                        <li class="profile-button">
                            <select class="top_line-currency">
                                <option selected>АЛМАТЫ</option>
                                <option>ШЫМКЕНТ</option>
                                <option>ТАРАЗ</option>
                                <option>АСТАНА</option>
                                <option>АКТОБЕ</option>
                            </select>
                        </li>
                        <li class="profile-button">
                            <select class="top_line-currency lang">
                                <option selected>РУССКИЙ</option>
                                <option>КАЗАХСКИЙ</option>
                                <option>ENGLISH</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row"><!-- NAVBAR -->
            <div class="col-md-2 col-xs-2 text-left d-flex justify-content-center align-items-center d-none">
                <?= Html::a(Html::img('@web/common/img/header/logo.png' ), ['site/index']) ?>
            </div>
            <div class="col-md-8 col-xs-8 text-center">
                <nav class="navbar navbar-expand-lg navbar-dark bg-menu-mobile">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <?= Menu::showMenu() ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-2 col-xs-2 text-right d-flex justify-content-end align-items-center d-none">
                <ul class="profile-menu d-flex justify-content-center align-items-center">
                    <li class="profile-button pl-0 pr-4" style="border-right: none;">
                        <?= Html::a('Поиск', ['site/index']) ?>
                    </li>
                </ul>
            </div>
        </div> <!-- NAVBAR -->
    </div>
</header>


<?php $this->beginBody() ?>

    <?= $content ?>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 foot-navigation">
                <ul class="pt-3 pb-3">
                    <li><a class="pt-2 pb-2" href="#">Главная</a></li>
                    <li><a class="pt-2 pb-2" href="#">О компании</a></li>
                    <li><a class="pt-2 pb-2" href="#">Туры</a></li>
                    <li><a class="pt-2 pb-2" href="#">Новости</a></li>
                    <li><a class="pt-2 pb-2" href="#">Как купить</a></li>
                </ul>
            </div>
        </div>
        <div class="row pt-3 pb-3">
            <div class="col-md-3 col-xs-3 pt-2 pb-2">
                <p class="copyright">© KazTravel.kz 2016 - 2017</p>
                <a href="#">Договор публичной оферты</a>
            </div>
            <div class="col-md-3 col-xs-3 pt-2 pb-2">
                <input class="search-input-footer" type="text" name="search" required placeholder="Поиск">
            </div>
            <div class="col-md-3 col-xs-3 pt-2 pb-2 footPhone">
                <p><?= Html::img('@web/common/img/footer/phone.png') ?>&nbsp;&nbsp;&nbsp;+7 (701) - 470 - 00 - 14</p>
                <a href="#">info@KazTravel.online</a>
            </div>
            <div class="col-md-3 col-xs-3 pt-2 pb-2 d-flex justify-content-center align-items-center">
                <a href="#"><?= Html::a(Html::img('@web/common/img/footer/vk.png' ), ['site/index']) ?></a>
                <a href="#"><?= Html::a(Html::img('@web/common/img/footer/face.png' ), ['site/index']) ?></a>
                <a href="#"><?= Html::a(Html::img('@web/common/img/footer/mail.png' ), ['site/index']) ?></a>
            </div>
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
