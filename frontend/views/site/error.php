<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = $name;
?>


<section class="section-header" style="background: url('../common/img/header/parallax-addtour.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2><?= Html::encode($this->title) ?></h2>
                    <p><?= nl2br(Html::encode($message)) ?></p>
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

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-5">
                <h1><?= Html::encode($this->title) ?></h1>

                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
                <p>
                    Вышеупомянутая ошибка возникла, когда веб-сервер обрабатывал ваш запрос.
                </p>
                <p>
                    Если вы считаете, что это ошибка сервера, свяжитесь с нами. Спасибо.
                </p>
            </div>
        </div>
    </div>
</section>
