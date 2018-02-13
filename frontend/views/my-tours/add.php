<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09.02.2018
 * Time: 15:55
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\Cities;
use common\models\Countries;

$cities = new Cities();
$countries = new Countries();

$this->title = 'Создание тура';
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

<section class="pt-5 pb-5" style="background: #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= Alert::widget() ?>
                <ul id="w2" class="cabinet-nav nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#rus" data-toggle="tab" aria-expanded="true"><span>РУССКИЙ</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#kaz" data-toggle="tab" aria-expanded="true"><span>ҚАЗАҚША</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#eng" data-toggle="tab" aria-expanded="true"><span>ENGLISH</span></a></li>
                </ul>
                <div class="tab-content">
                    <div id="rus" class="tab-pane set-tab-content active">
                        <?php $form = ActiveForm::begin(['id' => 'add-tour-rus', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Основная информация</h4>
                            </div>
                            <div class="col-md-12">
                                <hr style="10px 0">
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'name')->label('НАЗВАНИЕ*')->textInput(['required' => 'required']) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'category_id')->dropDownList($cities->getCountriesList())->label('УКАЖИТЕ КАТЕГОРИЮ*') ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'tour_language')->label('ДОСТУПНЫЕ ЯЗЫКИ ТУРА ИЛИ РАЗВЛЕЧЕНИЯ*')->textInput(['required' => 'required']) ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'mini_description')->textarea(['rows' => '5', 'placeholder' => 'Вы можете ввести только: 200 символов'])->label('КРАТКОЕ ОПИСАНИЕ*') ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'description')->textarea(['rows' => '5'])->label('ПОДРОБНОЕ ОПИСАНИЕ') ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'conditions')->textarea(['rows' => '5'])->label('УСЛОВИЯ ПРЕДСТАВЛЕНИЯ') ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'return_cond')->textarea(['rows' => '5'])->label('УСЛОВИЯ ВОЗВРАТА') ?>
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
                                <p style="margin-bottom:2rem;">ЗАГРУЗКА ИЗОБРАЖЕНИЯ (800 X 533)<span style="color: red;">*</span></p>
                                <?= $form->field($model, 'back_image')->fileInput()->label('') ?>
                            </div>
                            <div class="col-md-12">
                                <p style="margin-bottom:1rem;">Загрузка изображений для галереи</p>
                                <p style="margin-bottom:1rem;">В этом блоке загружаем фото тура для галереи.</p>

                                <p style="margin-bottom:1rem;"><strong>Размер изображения не должен превышать более 1 мегабайта, в ином случае система просто их не загрузит.</strong></p>

                                <p style="margin-bottom:1rem;"><strong>Для более корректного отображения Ваших изображений рекомендуется их подготовить.</strong></p>
                            </div>
                            <div class="col-md-12  py-4">
                                <?= $form->field($model, 'gallery')->fileInput()->label('') ?>
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
<!--                                --><?//= $form->field($model, 'price_child_free')->label('ВОЗРАСТ РЕБЕНКА ОТ')->textInput() ?>
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
                                <?= $form->field($model, 'country_id')->dropDownList($cities->getCountriesList())->label('СТРАНА*') ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'city_id')->dropDownList($cities->getCountriesList())->label('ГОРОД*') ?>
                            </div>
                            <div class="col-md-12">
                                <h4>Информация о точке сбора</h4>
                            </div>
                            <div class="col-md-12">
                                <hr style="10px 0">
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'dot_place')->label('АДРЕС ТОЧКИ СБОРА*')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'dot_place_addr')->label('ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ ПО АДРЕСУ ТОЧКИ СБОРА')->textInput() ?>
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
                            <div class="col-md-12">
                                <h4>Места посещения</h4>
                            </div>
                            <div class="col-md-12">
                                <hr style="10px 0">
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'place_id')->dropDownList($cities->getCountriesList())->label('ГОРОД*') ?>
                            </div>
                            <div class="col-md-12">
                                <hr style="10px 0">
                            </div>
                            <div class="col-md-12">
                                <?= Html::submitButton('Добавить тур', ['class' => 'btn-refresh-profile', 'name' => 'signup-button']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div id="kaz" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="color: red;">на стадий разработки</span>
                            </div>
                        </div>
                    </div>
                    <div id="eng" class="tab-pane set-tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="color: red;">на стадий разработки</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>