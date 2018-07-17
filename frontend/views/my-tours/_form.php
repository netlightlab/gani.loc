<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.07.2018
 * Time: 17:04
 */

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use common\models\Cities;
use common\models\Categories;
use mihaildev\ckeditor\CKEditor;

$cities = new Cities();
$category = new Categories;

?>


<?php $form = ActiveForm::begin(['id' => 'tours_add', 'options' => ['enctype' => 'multipart/form-data']]); ?>

<ul id="w2" class="cabinet-nav nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" href="#rus" data-toggle="tab" aria-expanded="true"><span>РУССКИЙ</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#kaz" data-toggle="tab" aria-expanded="true"><span>ҚАЗАҚША</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#eng" data-toggle="tab" aria-expanded="true"><span>ENGLISH</span></a></li>
</ul>
<div class="tab-content">
    <div id="rus" class="tab-pane set-tab-content active">
        <div class="row">
            <div class="col-md-12">
                <h4>Основная информация</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'name')->label('НАЗВАНИЕ*')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'category_id')->dropDownList($category->getCategoriesList())->label('УКАЖИТЕ КАТЕГОРИЮ*') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'tour_language')->label('ДОСТУПНЫЕ ЯЗЫКИ ТУРА ИЛИ РАЗВЛЕЧЕНИЯ*')->textInput() ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'mini_description')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('КРАТКОЕ ОПИСАНИЕ*');?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('ПОДРОБНОЕ ОПИСАНИЕ*');?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'conditions')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('УСЛОВИЯ ПРЕДСТАВЛЕНИЯ');?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'return_cond')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('УСЛОВИЯ ВОЗВРАТА');?>
            </div>
            <div class="col-md-12">
                <h4>Настройка изображения</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-12">
                <p style="margin-bottom:1rem;">В данном блоке необходимо загрузить изображение Вашего тура для отображения на сайте, также указать обложку тура, которая отображается на Вашей странице.</p>

                <p style="margin-bottom:1rem;"><strong>Формат только jpg, размер файла желательно не должен превышать более 1 мегабайта.</strong></p>

                <p style="margin-bottom:1rem;"><strong>Для более корректного отображения Ваших изображений рекомендуется их подготовить учитывая</strong></p>
            </div>
            <div class="col-md-6 py-4">
                <p style="margin-bottom:2rem;">ЗАГРУЗКА ИЗОБРАЖЕНИЯ (800 X 533)<span style="color: red;">*</span></p>
                <?= $form->field($model, 'mini_image')->fileInput()->label('') ?>
            </div>
            <div class="col-md-6  py-4">
                <p style="margin-bottom:2rem;">ЗАГРУЗКА ИЗОБРАЖЕНИЯ (1600 X 450)<span style="color: red;">*</span></p>
                <?= $form->field($model, 'back_image')->fileInput()->label('') ?>
            </div>
            <div class="col-md-12">
                <p style="margin-bottom:1rem;">Загрузка изображений для галереи</p>
                <p style="margin-bottom:1rem;">В этом блоке загружаем фото тура для галереи.</p>

                <p style="margin-bottom:1rem;"><strong>Размер изображения не должен превышать более 1 мегабайта, в ином случае система просто их не загрузит.</strong></p>

                <p style="margin-bottom:1rem;"><strong>Для более корректного отображения Ваших изображений рекомендуется их подготовить.</strong></p>
            </div>
            <div class="col-md-12  py-4">
                <p>Загрузите галерею фотографии:</p>
                <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
            </div>
            <div class="col-md-12">
                <h4>Настройка цен</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'price')->label('ЦЕНА (СТАНДАРТНАЯ)*')->textInput() ?>
            </div>
            <div class="col-md-12">
                <h4>Детский билет (Платный)</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'price_child')->label('ЦЕНА (СТАНДАРТНАЯ)')->textInput() ?>
            </div>
            <div class="col-md-12">
                <h4>Детский билет (Бесплатный)</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'price_child_free')->label('ВОЗРАСТ РЕБЕНКА ОТ')->textInput() ?>
            </div>
            <div class="col-md-12">
                <h4>Информация о местонахождении</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'official_name')->label('ОФИЦИАЛЬНОЕ НАЗВАНИЕ ОБЪЕКТА* ')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'country_id')->dropDownList($cities->getCountriesList(), ['id' => 'CountryId'])->label('СТРАНА*') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'city_id')->dropDownList($cities->getCitiesList(1), ['id' => 'CitiesList'])->label('ГОРОД*') ?>
            </div>
            <div class="col-md-12">
                <h4>Информация о точке сбора</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'dot_place_addr')->label('АДРЕС ТОЧКИ СБОРА*')->textInput(['placeholder' => 'укажите на карте', 'id' => 'dot_placeAddr', 'readonly' => true]) ?>
            </div>
            <div class="col-md-6" style="display: none;">
                <?= $form->field($model, 'dot_place')->label('ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ ПО АДРЕСУ ТОЧКИ СБОРА')->textInput(['type' => 'text', 'id' => 'hidden_placeId']) ?>
            </div>
            <div class="col-md-12">
                <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
                <p style="font-size: 11px;">УКАЖИТЕ ТОЧКУ СБОРА НА КАРТЕ*</p>
                <div id="map"></div>
            </div>
            <div class="col-md-12">
                <h4>Что входит:</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'w_included')->label('Что входит в тур*')->textInput() ?>
            </div>
            <!--                            <div class="col-md-12">-->
            <!--                                <h4>Места посещения</h4>-->
            <!--                            </div>-->
            <!--                            <div class="col-md-12">-->
            <!--                                <hr style="10px 0">-->
            <!--                            </div>-->
            <!--                            <div class="col-md-12">-->
            <!--                                --><?//= $form->field($model, 'place_id')->dropDownList($cities->getCountriesList())->label('ГОРОД*') ?>
            <!--                            </div>-->
        </div>
    </div>
    <div id="kaz" class="tab-pane set-tab-content">
        <div class="row">
            <div class="col-md-12">
                <h4>Основная информация</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'name_kz')->label('НАЗВАНИЕ KZ*')->textInput() ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'mini_description_kz')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('КРАТКОЕ ОПИСАНИЕ KZ*'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'description_kz')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('ПОДРОБНОЕ ОПИСАНИЕ KZ*'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'conditions_kz')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('УСЛОВИЯ ПРЕДСТАВЛЕНИЯ KZ'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'return_cond_kz')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('УСЛОВИЯ ВОЗВРАТА KZ'); ?>
            </div>
        </div>
    </div>
    <div id="eng" class="tab-pane set-tab-content">
        <div class="row">
            <div class="col-md-12">
                <h4>Основная информация</h4>
            </div>
            <div class="col-md-12">
                <hr style="10px 0">
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'name_en')->label('НАЗВАНИЕ ENG*')->textInput() ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'mini_description_en')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('КРАТКОЕ ОПИСАНИЕ ENG*'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'description_en')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('ПОДРОБНОЕ ОПИСАНИЕ ENG*'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'conditions_en')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('УСЛОВИЯ ПРЕДСТАВЛЕНИЯ ENG'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'return_cond_en')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'preset' => 'standart',
                    ],
                ])->label('УСЛОВИЯ ВОЗВРАТА ENG'); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <hr style="10px 0">
    </div>
    <div class="col-md-12">
        <?= Html::submitButton('Добавить тур', ['class' => 'btn-refresh-profile', 'name' => 'signup-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
