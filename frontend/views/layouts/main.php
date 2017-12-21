<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use frontend\models\Menu;

AppAsset::register($this);
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

    <script src="/gani.loc/frontend/web/common/assets/vendors/jquery.min.js"></script>
    <script src="/gani.loc/frontend/web/common/assets/owlcarousel/owl.carousel.js"></script>
</head>
<body>

<header>
    <div class="container">
        <div class="row pt-3 pb-3"><!-- NAVBAR -->
            <div class="col-md-2 col-xs-2 text-left d-flex justify-content-center align-items-center d-none">
                <img src="common/img/header/logo.png">
            </div>
            <div class="col-md-8 col-xs-8 text-center">
                <nav class="navbar navbar-expand-lg navbar-dark bg-menu-mobile">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <?= Menu::showMenu() ?>
                            <!--<li class="nav-item active">
                                <?/*= Html::a("Главная", ["site/index"], ["class" => "nav-link"])*/?>
                            </li>
                            <li class="nav-item">
                                <?/*= Html::a("О компании", ["site/page/id=1"], ["class" => "nav-link"])*/?>
                            </li>
                            <li class="nav-item">
                                <?/*= Html::a("Туры", ["index"], ["class" => "nav-link"])*/?>
                            </li>
                            <li class="nav-item">
                                <?/*= Html::a("Новости", ["index"], ["class" => "nav-link"])*/?>
                            </li>
                            <li class="nav-item">
                                <?/*= Html::a("Как купить", ["index"], ["class" => "nav-link"])*/?>
                            </li>
                            <li class="nav-item mobile-registration">
                                <ul class="profile-menu d-flex justify-content-center align-items-center">
                                    <li class="profile-button pl-0 pr-4">
                                        <?php
/*                                        if (Yii::$app->user->isGuest) {
                                            echo Html::a("Войти", ["site/login"], ["class" => "nav-link"]).Html::img('common/img/header/enter_profile.png');
                                        } else {
                                            echo Html::a("Кабинет", ["profile/index"], ["class" => "nav-link"]);
                                        }
                                        */?>
                                    </li>
                                    <li class="profile-button pl-0 pr-4">
                                        <?php
/*                                        if (Yii::$app->user->isGuest) {
                                            echo Html::a("Регистрация", ["site/signup"], ["class" => "nav-link"]).Html::img('common/img/header/register_profile.png');
                                        } else {
                                            echo
                                                Html::beginForm(['/site/logout'], 'post')
                                                . Html::submitButton(
                                                    'Выход (' . Yii::$app->user->identity->username . ')',
                                                    ['class' => 'nav-link exit-account']
                                                )
                                                . Html::endForm();

                                        }
                                        */?>
                                    </li>
                                </ul>
                            </li>-->
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-2 col-xs-2 text-right d-flex justify-content-end align-items-center d-none">
                <ul class="profile-menu d-flex justify-content-center align-items-center">
                    <li class="profile-button pl-0 pr-4">
                    <?php
                    if (Yii::$app->user->isGuest) {
                        echo Html::a("Войти", ["site/login"], ["class" => "nav-link"]).Html::img('common/img/header/enter_profile.png');
                    } else {
                        echo Html::a("Кабинет", ["profile/index"], ["class" => "nav-link"]);
                    }
                    ?>
                    </li>
                    <li class="profile-button pl-0 pr-4">
                        <?php
                        if (Yii::$app->user->isGuest) {
                            echo Html::a("Регистрация", ["site/signup"], ["class" => "nav-link"]).Html::img('common/img/header/register_profile.png');
                        } else {
                            echo
                                Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                    'Выход (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'nav-link exit-account']
                                )
                                . Html::endForm();
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div> <!-- NAVBAR -->
    </div>
</header>


<?php $this->beginBody() ?>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 foot-navigation">
                <ul class="pt-3 pb-3">
                    <li><a href="#">Главная</a></li>
                    <li><a href="#">О компании</a></li>
                    <li><a href="#">Туры</a></li>
                    <li><a href="#">Новости</a></li>
                    <li><a href="#">Как купить</a></li>
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
                <p><img src="common/img/footer/phone.png">&nbsp;&nbsp;&nbsp;+7 (701) - 470 - 00 - 14</p>
                <a href="#">info@tourcenter.online</a>
            </div>
            <div class="col-md-3 col-xs-3 pt-2 pb-2 d-flex justify-content-center align-items-center">
                <a href="#"><img src="common/img/footer/vk.png"></a>
                <a href="#"><img src="common/img/footer/face.png"></a>
                <a href="#"><img src="common/img/footer/mail.png"></a>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
