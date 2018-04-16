<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.04.2018
 * Time: 10:22
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\jui\Slider;
use yii\jui\SliderInput;
use yii\widgets\Pjax;

?>





<p>От <span id="price-from-value"></span></p>
<p>До <span id="price-to-value"></span></p>

<?php Pjax::begin(['id' => 'search-form', 'enablePushState' => false]) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <?//= $form->field($search_form, 'price_from')->input('range', ['min' => 10000, 'max' => 100000]) ?>
    <?//= $form->field($search_form, 'price_to')->textInput() ?>
    <?//= $form->field($search_form, 'user_id')->textInput() ?>
    <?//= $form->field($search_form,'price')->widget(Slider::className(), ['class' => 'range']) ?>
    <?= SliderInput::widget([
            'model' => $search_form,
            'attribute' => 'price_from',
            'clientOptions' => [
                'range' => true,
                'step' => 500,
                'min' => 0,
                'max' => 40000,
                'animate' => true,
            ],
            'clientEvents' => [
                'slide' => 'function(event, ui){
                    $("#tours-price_from").val(ui.values.join(","));
                    $("#price-from-value").text(ui.values[0]);
                    $("#price-to-value").text(ui.values[1]);
                }'
            ]
    ]) ?>
    <?= Html::submitButton('Отправить') ?>
    <?php ActiveForm::end(); ?>
<?php Pjax::end() ?>

<?php Pjax::begin(['id' => 'cont']) ?>
<? print_r(count($tours)) ?>
<? print_r(1) ?>
<?php Pjax::end() ?>

<?php

$this->registerJs(
    '$("document").ready(function(){ 
		$("#search-form").on("pjax:end", function(response) {
			$.pjax.reload({container:"#searchContainer"});
//            $("#searchContainer").html(21312);
		});
    });'
);
?>
