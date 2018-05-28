<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

    <?php $form = ActiveForm::begin(['class' => 'catalog_form' , 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true, 'placeholder' => 'Например: https://eltourism.kz/']) ?>

    <?= $form->field($model, 'page_id')->dropDownList($model->getPageList(), ['id' => 'CountryId']) ?>

    <?= $form->field($model, 'position')->dropDownList($model->getPositionList(1), ['id' => 'CitiesList']) ?>

    <?= $form->field($model, 'banner')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS
    $('#CountryId').change(function() {        
        $.ajax({
            'url'       : '/admin/banners/create',
            'method'    : 'post',
            'data'      : {'country_id': this.value},            
            'dataType'  : 'json',
            'success'   : function(data) {
                var options = [];
                for (var value in data) {
                    if (data.hasOwnProperty(value)) {
                        options.push('value="' + value + '">' + data[value]);
                    }
                }
                document.getElementById('CitiesList').innerHTML = '<option ' + options.join('</option><option ') + '</option>';
                console.log(data);
            },
        });
    });
JS;

$this->registerJs($script);

?>