<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.04.2018
 * Time: 10:35
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\Cities;
use common\models\Countries;

?>


<section class="section-header" style="background: url('../common/img/header/parallax-partner-cabinet.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>ПРИВЕТСТВУЕМ!</h2>
                    <p>Личный кабинет тур компаний <?= $UsersInfo['name_company'] ?></p>
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
            <div class="col-md-12">
                <? foreach($pays as $pay): ?>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Информация о заказе</h3>
                        <p>Номер заказа: <?= $pay['order_id'] ?></p>
                        <p>Тур: <?= $pay['tours']['name'] ?></p>
                        <p>Оплачен: <?= $pay['orderInfo']['paid'] ? 'Да' : 'Нет' ?></p>
                        <p>Сумма: <?= $pay['sum'] ?></p>
                        <?php if($pay['orderInfo']['paid'] || $pay['tickets']): ?>
                            <h2>Билет</h2>
                            <p>Номер: <?= $pay['tickets']['certificate'] ?></p>
                        <?php endif; ?>
                        <h3>Информация о покупателе</h3>
                        <p>Имя: <?= $pay['orderInfo']['customer']['username'] ?></p>
                        <p>Email: <?= $pay['orderInfo']['customer']['email'] ?></p>
                        <p>Телефон: <?= $pay['orderInfo']['customer']['phone'] ?></p>
                    </div>
                </div>
                    <hr />
                <? endforeach; ?>
            </div>
        </div>
    </div>
</section>