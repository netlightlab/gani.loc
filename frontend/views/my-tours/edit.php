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
use mihaildev\ckeditor\CKEditor;
use common\models\Categories;

$cities = new Cities();
$category = new Categories;

$this->title = 'Редактирование тура ';
?>

    <section class="section-header" style="background: url('../common/img/header/parallax-addtour.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="parallax-header-text">
                        <h2><?= $model->name ?></h2>
                        <p>Здесь вы можете отредактировать свой тур/развлечение</p>
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
                            <?php $form = ActiveForm::begin(['id' => 'edit-tour-rus', 'options' => ['enctype' => 'multipart/form-data']]); ?>
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
                                    <?= $form->field($model, 'category_id')->dropDownList($category->getCategoriesList())->label('УКАЖИТЕ КАТЕГОРИЮ*') ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'tour_language')->label('ДОСТУПНЫЕ ЯЗЫКИ ТУРА ИЛИ РАЗВЛЕЧЕНИЯ*')->textInput(['required' => 'required']) ?>
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
                                    ])->label('УСЛОВИЯ ПРЕДСТАВЛЕНИЯ*');?>
                                </div>
                                <div class="col-md-12">
                                    <?= $form->field($model, 'return_cond')->widget(CKEditor::className(), [
                                        'editorOptions' => [
                                            'inline' => false,
                                            'preset' => 'standart',
                                        ],
                                    ])->label('УСЛОВИЯ ВОЗВРАТА*');?>
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
                                    <p>Изображение</p>
                                    <?= Html::img('@web/common/tour_img/'.$model->id.'/'.$model->mini_image, ['style' => 'max-width:100%']) ?>
                                </div>
                                <div class="col-md-6 py-4">
                                    <p style="margin-bottom:2rem;">ЗАГРУЗКА ИЗОБРАЖЕНИЯ (1600 X 450)<span style="color: red;">*</span></p>
                                    <?= $form->field($model, 'back_image')->fileInput()->label('') ?>
                                    <p>Изображение</p>
                                    <?= Html::img('@web/common/tour_img/'.$model->id.'/'.$model->back_image, ['style' => 'max-width:100%']) ?>
                                </div>
                                <div class="col-md-12">
                                    <p style="margin-bottom:1rem;">Загрузка изображений для галереи</p>
                                    <p style="margin-bottom:1rem;">В этом блоке загружаем фото тура для галереи.</p>

                                    <p style="margin-bottom:1rem;"><strong>Размер изображения не должен превышать более 1 мегабайта, в ином случае система просто их не загрузит.</strong></p>

                                    <p style="margin-bottom:1rem;"><strong>Для более корректного отображения Ваших изображений рекомендуется их подготовить.</strong></p>
                                </div>
                                <div class="col-md-12  py-4">
                                    <p>Загруженные изображения:</p>
                                    <?php
                                    echo newerton\fancybox\FancyBox::widget([
                                        'target' => 'a[rel=fancybox]',
                                        'helpers' => true,
                                        'mouse' => true,
                                        'config' => [
                                            'maxWidth' => '90%',
                                            'maxHeight' => '90%',
                                            'playSpeed' => 7000,
                                            'padding' => 0,
                                            'fitToView' => false,
                                            'width' => '70%',
                                            'height' => '70%',
                                            'autoSize' => false,
                                            'closeClick' => false,
                                            'openEffect' => 'elastic',
                                            'closeEffect' => 'elastic',
                                            'prevEffect' => 'elastic',
                                            'nextEffect' => 'elastic',
                                            'closeBtn' => false,
                                            'openOpacity' => true,
                                            'helpers' => [
                                                'title' => ['type' => 'float'],
                                                'buttons' => [],
                                                'thumbs' => ['width' => 68, 'height' => 50],
                                                'overlay' => [
                                                    'css' => [
                                                        'background' => 'rgba(0, 0, 0, 0.8)'
                                                    ]
                                                ]
                                            ],
                                        ]
                                    ]);

                                    ?>
                                    <?php if ($model['gallery']):?>
                                        <hr class="tourLine">
                                        <div class="tour_gallery">
                                            <?php foreach (explode(',', $model['gallery']) as $item): ?>
                                                <div class="tour_gallery-thumb">
                                                    <?= Html::a(Html::img('@web/common/tour_img/'.$model->id.'/'.$item), '@web/common/tour_img/'.$model->id.'/'.$item, ['rel' => 'fancybox']); ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                    <?php endif; ?>
                                    <hr>
                                    <?php
                                    echo \kato\DropZone::widget([
                                        'options' => [
                                            'maxFilesize' => 10,
                                            'maxFiles' => 20,
                                            'url' => '/my-tours/edit?id='.Yii::$app->request->get('id'),
                                            'uploadMultiple' => true,
                                            'parallelUploads' => 10,
                                            'autoProcessQueue' => false,
                                        ],
                                        'clientEvents' => [
                                            'removedfile' => "function(file){alert(file.name + ' is removed')}"
                                        ],
                                    ]);
                                    ?>
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
                                    <?= $form->field($model, 'city_id')->dropDownList($cities->getCitiesList($model['country_id']), ['id' => 'CitiesList'])->label('ГОРОД*') ?>
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
                                <div class="col-md-12 mb-2">
                                    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
                                    <p style="font-size: 11px;">УКАЖИТЕ ТОЧКУ СБОРА НА КАРТЕ*</p>
                                    <div id="map"></div>
                                    <hr>
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
<!--                                <div class="col-md-12">-->
<!--                                    <h4>Места посещения</h4>-->
<!--                                </div>-->
<!--                                <div class="col-md-12">-->
<!--                                    <hr style="10px 0">-->
<!--                                </div>-->
<!--                                <div class="col-md-12">-->
<!--                                    --><?//= $form->field($model, 'place_id')->dropDownList($cities->getCountriesList())->label('ГОРОД*') ?>
<!--                                </div>-->
                                <div class="col-md-12">
                                    <hr style="10px 0">
                                </div>
                                <div class="col-md-12">
                                    <?= Html::submitButton('Сохранить изменения', ['class' => 'btn-refresh-profile', 'name' => 'signup-button']) ?>
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

<?php

$js = <<< JS

    $("#edit-tour-rus").on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        var photos = [];
        $.each(myDropzone.files, function(index, value) {
          photos.push(value.name);
        }) ;
        form += "&Tours%5Bgallery%5D="+photos;
        $.ajax({
            type: 'POST',            
            data: form,
            succes: function(response) {
                console.log(response);
            },
            error: function(error) {
              console.log(error)
            }
          }).done(function(){
                myDropzone.processQueue();
                window.location.href = '/partner/index';
          });
        return false;
    });
    
    $('#CountryId').change(function() {        
        $.ajax({
            'url'       : '/partner/index',
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
            }
        });
    });

ymaps.ready(init);

function init() {
    var getCoordinat = $('#hidden_placeId').val();
    var myCoords = getCoordinat.split(',');
    
    var myPlacemark,
        myMap = new ymaps.Map('map', {
            center: [myCoords[0], myCoords[1]],
            zoom: 14
        }, {
            searchControlProvider: 'yandex#search'
        });
    
     myPlacemark = createPlacemark([myCoords[0], myCoords[1]]);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
            getAddress(getCoordinat);

    // Слушаем клик на карте.
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');
        
        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getAddress(coords);
    });

    // Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            preset: 'islands#violetDotIconWithCaption',
            draggable: true
        });
    }

    // Определяем адрес по координатам (обратное геокодирование).
    function getAddress(coords) {
        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);

            myPlacemark.properties
                .set({
                    // Формируем строку с данными об объекте.
                    iconCaption: [
                        // Название населенного пункта или вышестоящее административно-территориальное образование.
                        firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                        // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                    ].filter(Boolean).join(', '),
                    // В качестве контента балуна задаем строку с адресом объекта.
                    balloonContent: firstGeoObject.getAddressLine()                    
                });
            // console.log('dots: ' + coords + ' name: '+firstGeoObject.getAddressLine());
            $('#dot_placeAddr').val(firstGeoObject.getAddressLine());
            $('#hidden_placeId').val(coords);            
        });
    }
}


JS;
$this->registerJs($js);
?>