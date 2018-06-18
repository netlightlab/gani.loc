<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\models\Menu;
use yii\widgets\Pjax;
use yii\helpers\Url;

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
                                echo Html::a(Html::img('@web/common/img/header/enter_profile.png')."Войти", ["site/login"], ["class" => "nav-link"]);
                            } else {
                                echo Menu::showCab();
                            }
                            ?>
                        </li>
                        <li class="profile-button">
                            <?php
                            if (Yii::$app->user->isGuest) {
                                echo Html::a(Html::img('@web/common/img/header/register_profile.png')."Регистрация", ["site/signup"], ["class" => "nav-link"]);
                            } else {
                                echo
                                    Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        Html::img('@web/common/img/header/logout.png')."ВЫЙТИ",
                                        ['class' => 'nav-link exit-account']
                                    )
                                    . Html::endForm();
                            }
                            ?>
                        </li>
                        <li class="profile-button">
                            <select class="top_line-currency">
                                <option selected>АЛМАТЫ</option>
                                <option>ШЫМКЕНТ</option>
                                <option>ТАРАЗ</option>
                                <option>АСТАНА</option>
                                <option>АКТОБЕ</option>
                            </select>
                        </li>
                        <li class="">
                            <!--<select class="top_line-currency lang">
                                <option selected>РУССКИЙ</option>
                                <option>КАЗАХСКИЙ</option>
                                <option>ENGLISH</option>
                            </select>-->
                            <?= \frontend\widgets\MultiLang\MultiLang::widget() ?>
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
            <div class="col-md-7 col-xs-7 text-center">
                <nav class="navbar navbar-expand-lg navbar-dark bg-menu-mobile">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <?= Menu::newMenu() ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-3 col-xs-3 text-right d-flex justify-content-end align-items-center d-none">
                <ul class="profile-menu d-flex justify-content-center align-items-center">
                    <li class="profile-button pl-0 pr-4" style="border: none;">
                        <?= Html::a('КОРЗИНА ('.count(Yii::$app->session->get("tour_id")).')', Url::to(['cart/index']), ["class" => "nav-link"]) ?>
                    </li>
                    <li class="profile-button pl-0 pr-4" style="border: none;">
                        <?= Html::a('ПОИСК', ['site/index']) ?>
                    </li>
                </ul>
            </div>
        </div> <!-- NAVBAR -->
    </div>
</header>
</div>

<?php $this->beginBody() ?>

    <?= $content ?>


<footer>
    <div class="container">
        <div class="row pt-3 pb-3">
            <div class="col-md-3 col-xs-3 pt-2 pb-2">
                <p class="copyright">© Eltourism.kz 2016 - 2017</p>
                <a href="#">Договор публичной оферты</a>
            </div>
            <div class="col-md-3 col-xs-3 pt-2 pb-2">
                <? $form = \yii\widgets\ActiveForm::begin([
                    'action' => '/global-search/global-search/',
                    'method' => 'GET'
                ]) ?>
                <?= Html::input('text', 'param', '', ['class' => 'search-input-footer', 'placeholder' => 'Поиск']) ?>
                <? \yii\widgets\ActiveForm::end() ?>
            </div>
            <div class="col-md-3 col-xs-3 pt-2 pb-2 footPhone">
                <p><?= Html::img('@web/common/img/footer/phone.png') ?>&nbsp;&nbsp;&nbsp;+7 (___) - ___ - __ - __</p>
                <a href="#">info@eltourism.kz</a>
            </div>
            <div class="col-md-3 col-xs-3 pt-2 pb-2 d-flex justify-content-center align-items-center">
                <a href="#"><?= Html::a(Html::img('@web/common/img/footer/vk.png' ), ['site/index']) ?></a>
                <a href="#"><?= Html::a(Html::img('@web/common/img/footer/face.png' ), ['site/index']) ?></a>
                <a href="#"><?= Html::a(Html::img('@web/common/img/footer/mail.png' ), ['site/index']) ?></a>
            </div>
        </div>
    </div>
</footer>


<script type="text/javascript">
    var yaParams = {};
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://ip.up66.ru/', true);
    xhr.onload = function() {

        yaParams.ip = this.responseText;
    }
    xhr.send();
</script>


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter48947582 = new Ya.Metrika({
                    id:48947582,
                    params:window.yaParams,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/48947582" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
