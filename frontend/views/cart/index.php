<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.03.2018
 * Time: 12:16
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;

$this->title = 'Корзина';

?>

    <section class="section-header" style="background: url('../common/img/header/ms.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="parallax-header-text">
                        <h2>КОРЗИНА</h2>
                        <p>Здесь вы можете оформить тур.</p>
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
                    <?= Alert::widget() ?>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 pb-5" style="background: #f9f9f9;">
        <? if(is_array($orders)): ?>
            <? $form = ActiveForm::begin(['method' => "POST", "action" => "/cart/checkout", 'options' => ['style' => 'width: 100%']]); ?>
            <div class="container">
                <div class="row">
                    <main class="col-md-9">
                        <? foreach($orders as $order): ?>
                            <article data-row="<?= $order->id ?>" class="basket_box ">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="basket_image">
                                            <?= Html::img(['/common/tour_img/'.$order->id.'/'.$order->mini_image], ['style' => 'max-width: 100%']) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="basket_description"><?= $order->name ?></p>
                                            </div>
                                        </div>
                                        <div class="row" id="basket-price_info">
                                            <div class="col-md-4">
                                                <span>Количество:</span>
                                            </div>
                                            <div class="col-md-4">
                                                <span>Сумма:</span>
                                            </div>
                                        </div>
                                        <div class="row" id="basket-price_inputs">
                                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                <div class="counter">
                                                    <?= $form->field($model, $order->id.'[qty]')->textInput(['type' => 'number', 'value' => 1, 'min' => 1, 'data-price' => $order->price, 'data-id' => $order->id, 'class' => 'basket-nubmer_tours'])->label('') ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 d-flex align-items-center price">
                                                <span style="font-size: 1.2rem; font-weight: bold; margin-bottom: 1rem" class="price_<?= $order->id ?>"><?= $order->price ?> тг.</span>
                                                <?= $form->field($model, $order->id.'[sum]')->hiddenInput(['value' => $order->price, 'class' => 'hiddenPrice_'.$order->id])->label('') ?>
                                            </div>
                                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                <!--hidden fields-->
                                                <?= $form->field($model, $order->id.'[tour_id]')->hiddenInput(['value' => $order->id])->label('') ?>
                                                <!--#hidden fields-->
                                                <?= Html::a('Удалить &times;', '#', ['class' => 'remove-from-cart', 'data-remove' => $order->id]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <? endforeach;?>
                    </main>
                    <aside class="col-md-3" id="fixed-basket">
                        <div class="row fixed-basket">
                            <div class="col-md-12">
                                <span>Общая сумма</span>
                                <?= $form->field($model, 'total')->textInput(['value' => '', 'id' => 'total-price', 'readonly' => 'readonly'])->label(''); ?>
                            </div>
                            <div class="col-md-12">
                                <?= Html::submitButton('Оформить заказ', ['class' => 'alltours_btn-info', 'style' => 'cursor: pointer; border: none;']) ?>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        <? else: ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><strong>УПС</strong> Корзина пуста</h2>
                    </div>
                </div>
            </div>
        <? endif; ?>
    </section>
<?php


$script = <<<JS
    $(document).ready(function(){
        
        /*$('#do-order').click(function(){
             
        });*/
        
        $('.remove-from-cart').click(function(event){
            event.preventDefault();
            var id = $(this).attr('data-remove');
            $.ajax({
                type: 'POST',
                url: '/cart/remove-from-cart',
                data: { id: id },
                success: function(response){
                    $('[data-row=' + id + ']').remove();
                    
                    /*Удаляем значение из суммы тотал вместе с item*/
                    var 
                        pricesZ = $('.price span'),
                        itemsPriceZ = 0;
                    /*if(prices.length > 1){*/
                        for (var i = 0; i < pricesZ.length; i++){
                            itemsPriceZ += parseInt(pricesZ[i].innerText);
                        }
                    /*}else{
                        itemsPrice = oneTotalPrice;   
                    }*/ 
                    console.log(pricesZ.length);
                    $('#total-price').val(itemsPriceZ);
                    /*#Удаляем значение из суммы тотал вместе с item*/
                }
            });  
        });
        
        $('.counter input').on('change', function(event){
            var 
                dataPrice = $(this).data('price'),
                counterValue = $(this).val(),
                oneTotalPrice = dataPrice * counterValue,
                itemsPrice = 0,
                priceSpan = $('.price_'+$(this).data('id')),
                pricesX = $('.price span'),
                itemsPriceX = 0,
                hiddenPriceInput = $('.hiddenPrice_'+$(this).data('id'));
            
                priceSpan.html(oneTotalPrice+' тг.');
                hiddenPriceInput.val(oneTotalPrice);
                
                
                /*строим тотал прайс при изменении одного значения цены*/
                
                if(pricesX.length > 1){
                    for (var i = 0; i < pricesX.length; i++){
                        itemsPriceX += parseInt(pricesX[i].innerText);
                    }
                }else{
                    itemsPriceX = oneTotalPrice;   
                } 
                $('#total-price').val(itemsPriceX);
                /*#строим тотал прайс при изменении одного значения цены*/
        });
        
        /*формируем значение для поля total price*/
        var prices = $('.price span'),
            totalPrice = 0;
			
        console.log(prices.length);
        for (var i = 0; i < prices.length; i++){            
            totalPrice += parseInt(prices[i].innerText);
			console.log(i + ': ' + prices[i].innerText);
			console.log('ojbect_' + i + ': ' + prices[i]);
			console.log('total: ' + totalPrice);
        }
        console.log(totalPrice);
        $('#total-price').val(totalPrice);
        /*#формируем значение для поля total price*/

    });
JS;

$this->registerJs($script);



?>