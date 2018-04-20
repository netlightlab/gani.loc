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

$this->title = 'Покупки';

?>


<section class="section-header" style="background: url('../common/img/header/parallax-partner-cabinet.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>Информация о покупках!</h2>
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

<section class="py-5" style="background: #f9f9f9;">
    <div class="container">
        <div class="row py-3" style="background: #fff;border-radius: 8px;box-shadow: 0 1px 3px lightgrey;">
            <div class="col-md-12">
                <?= Alert::widget() ?>
            </div>
            <div class="col-md-12">
                <h2>Номера заказов:</h2>
                <hr>
            </div>
            <? foreach($pays as $pay): ?>
                <article class="col-md-2 my-3">
                    <div class="pays-order">
                        <span><?= $pay['order_id'] ?></span>
                        <div></div>
                        <a data-link_id="<?= $pay['order_id'] ?>" href=""></a>
                        <p>Подробнее</p>
                    </div>
                    <div class="showBox"></div>
                    <div id="<?= $pay['order_id'] ?>" class="pays-info">
                        <div class="pays-box">
                            <div class="pays-header">
                                <h5>Заказ № <?= $pay['order_id'] ?></h5><span class="dataLinkClose">&times;</span>
                                <hr>
                            </div>
                            <div class="pays-body">
                                <h3>Информация о заказе</h3>
                                <hr>
                                <p>Номер заказа: <span><b><?= $pay['order_id'] ?></b></span></p>
                                <p>Тур: <b><?= $pay['tours']['name'] ?></b></p>
                                <p>Оплачен: <b><?= $pay['orderInfo']['paid'] ? 'Да' : 'Нет' ?></b></p>
                                <p>Сумма: <b><?= $pay['sum'] ?></b> тг.</p>
                                <?php if($pay['orderInfo']['paid'] || $pay['tickets']): ?>
                                    <p>Номер билета: <b style="color:red;"><?= $pay['tickets']['certificate'] ?></b></p>
                                <?php endif; ?>
                                <hr>
                                <h3>Информация о покупателе</h3>
                                <hr>
                                <p>Имя: <b><?= $pay['orderInfo']['customer']['username'] ?></b></p>
                                <p>Email: <b><?= $pay['orderInfo']['customer']['email'] ?></b></p>
                                <p>Телефон: <b><?= $pay['orderInfo']['customer']['phone'] ?></b></p>
                            </div>
                        </div>
                    </div>
                </article>
            <? endforeach; ?>
        </div>
    </div>
</section>

<?php
$script = <<<JS
   $(".pays-order").click(function(event) {
       event.preventDefault();
       var dataLink = $(this).find('a').attr("data-link_id");
       var elemId = $(this).next().next().attr('id');
       if (dataLink == elemId) {
           $(this).next().next().addClass('active');
           $(".showBox").toggleClass('hidden');
           console.log(dataLink+":"+elemId);
       }
   });

   $(".dataLinkClose").click(function() {
        $(".pays-info").removeClass('active');
        $(".showBox").removeClass('hidden');
   });
   
   $(document).mouseup(function(event) {
        var div = $(".pays-info");
        if (!div.is(event.target) && div.has(event.target).length === 0) {
            $(".pays-info").removeClass('active');
            $(".showBox").removeClass('hidden');
        }
   });
JS;

$this->registerJs($script);

?>