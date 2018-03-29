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

?>

<div style="height:200px"></div>

<div class="container">
    <div class="row">
        <h1>Корзина</h1>
    </div>
</div>

<div class="container">
    <div class="row">
            <div class="col-12">
                <?= Alert::widget() ?>
            </div>
            <?/* print_r($model) */?>
            <?/* print_r($_SESSION) */?>
            <? if(is_array($orders)): ?>
                <div class="col-12">
                    <? $form = ActiveForm::begin(['method' => "POST", "action" => "/cart/checkout", 'options' => ['style' => 'width: 100%']]); ?>
                        <div class="row">
                            <div class="col-8">
                                <? foreach($orders as $order): ?>
                                    <div class="col-md-12 order-row" data-row="<?= $order->id ?>">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <?= Html::img(['/common/tour_img/'.$order->id.'/'.$order->mini_image], ['style' => 'max-width: 100%']) ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $order->name ?>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="counter">
                                                    <?= $form->field($model, $order->id.'[qty]')->textInput(['type' => 'number', 'value' => 1, 'min' => 1, 'data-price' => $order->price, 'data-id' => $order->id])->label('') ?>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="price">
                                                    <span class="price_<?= $order->id ?>"><?= $order->price ?></span>
                                                </div>
                                                <?= $form->field($model, $order->id.'[sum]')->hiddenInput(['value' => $order->price, 'class' => 'hiddenPrice_'.$order->id])->label('') ?>
                                            </div>
                                            <div class="col-md-1">
                                                <?= Html::a('Удалить', '#', ['class' => 'remove-from-cart', 'data-remove' => $order->id]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--hidden fields-->
                                    <?= $form->field($model, $order->id.'[tour_id]')->hiddenInput(['value' => $order->id])->label('') ?>
                                    <!--#hidden fields-->
                                <? endforeach;?>
                            </div>
                            <?= $form->field($model, 'total')->textInput(['value' => '', 'id' => 'total-price']) ?>
                            <div class="col-3">
                                <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            <? else: ?>
                <p>Корзина пуста</p>
            <? endif; ?>
        </div>
        <!--<div class="col-3 offset-1">
            <?/*= Html::a('Оформить заказ', ['/orders/index'], ['class' => 'btn btn-primary']) */?>
        </div>-->
    </div>
</div>

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
            
                priceSpan.html(oneTotalPrice);
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
        for (var i = 0; i < prices.length; i++){
            totalPrice += parseInt(prices[i].innerText);
        }
        $('#total-price').val(totalPrice);
        /*#формируем значение для поля total price*/

    });
JS;

$this->registerJs($script);



?>