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







<?// print_r($formParams) ?>
<?// Pjax::begin(['options' => ['enablePushState' => true]]) ?>
<?php $form = ActiveForm::begin([
    'action' => ['/tours/search'],
    'id' => 'filterForm',
    'method' => 'GET',
    'options' => [
            'data-pjax' => true
        ]
    ]); ?>
    <p>Сортировать</p>
    <?= Html::dropDownList('sort', $formParams['sort'],[
            'sort' => '',
            'price' => 'Цена возрастание',
            '-price' => 'Цена убывание',
            'name' => 'Название А-Я',
            '-name' => 'Название Я-А',
    ], [
            'id' => 'sorter'
    ]) ?>
    <hr />
    <p>Категории</p>
    <?= Html::checkboxList('filter_categories', $formParams['filter_categories'], $categories) ?>
    <hr />
    <p>Ценовой диапазон</p>
    <div style="display: flex; justify-content: space-between;">
        <p>От <span id="price-from-value"></span></p>
        <p>До <span id="price-to-value"></span></p>
    </div>
    <?= SliderInput::widget([
//            'model' => $search_form,
//            'attribute' => 'price_from',
            'clientOptions' => [
                'range' => true,
                'step' => 500,
                'min' => 500,
                'max' => $formParams['max_price'],
                'animate' => true,
                'values' => [$formParams['price_from'], $formParams['price_to']]
            ],
            'clientEvents' => [
                'create' => 'function(event, ui){
                    if(ui.values === undefined){
                        ui.values = {
                            0: '. $formParams['price_from'] .',
                            1: '. $formParams['price_to'] .'
                        };
                    }
                    var value_from = ui.values[0] ? ui.values[0] = '. $formParams['price_from'] .' : '. $formParams['price_from'] .',
                        value_to   = ui.values[1] ? ui.values[1] = '. $formParams['price_to'] .' : '. $formParams['price_to']  .';
                    $("#price_from").val(value_from);
                    $("#price_to").val(value_to);
                    $("#price-from-value").text(value_from);
                    $("#price-to-value").text(value_to);
                }',
                'slide' => 'function(event, ui){
                console.log(event.target);
                    var value_from = ui.values[0] ? ui.values[0] : '. $formParams['price_from'] .',
                        value_to   = ui.values[1] ? ui.values[1] : '. $formParams['price_to']  .';
                    $("#price_from").val(value_from);
                    $("#price_to").val(value_to);
                    $("#price-from-value").text(value_from);
                    $("#price-to-value").text(value_to);
                }'
            ]
]) ?>
    <?= Html::input('hidden', 'price_from', '', ['id' => 'price_from']) ?>
    <?= Html::input('hidden', 'price_to', '', ['id' => 'price_to']) ?>
    <?= Html::submitButton('Применить', ['style' => 'margin-top: 20px;']) ?>
    <?= Html::a('Сбросить', ['tours/search'], ['data-pjax' => 1, 'id' => 'lll']) ?>
<?php ActiveForm::end(); ?>
<?// Pjax::end() ?>

<?php

$js = <<<JS
    var searchContainer = $("#searchContainer");
    searchContainer.on("pjax:start", function(){
        console.log('loading');
    });
    searchContainer.on("pjax:end", function(){
        console.log('ready');
        // $.pjax.reload({container: searchContainer});
    });
    $('#lll').on('click', function(){
        $('#filterForm').trigger('reset');  
    })
JS;


$this->registerJs($js);

?>
