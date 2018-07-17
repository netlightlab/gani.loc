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

$alias = Yii::getAlias('@web');

$this->title = 'Редактирование тура ';
?>

    <section class="section-header" style="background: url('<?= $alias ?>/common/img/header/parallax-addtour.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="parallax-header-text">
                        <h1><?= $model->name ?></h1>
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
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </section>

<?php

$js = <<< JS
    
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
    
    //удаляем картинку галереи
    $('.delete_image_link').on('click', function(event){
        event.preventDefault();
        var id = $(this).data('delete'),
            container = $(this).parent();
        console.log(id);
        $.ajax({
            method: 'POST',
            data: {
                deleteImage: 1,
                imageId : id
            }
        }).done(function(response){
            container.remove();
        })
    })
}


JS;
$this->registerJs($js);
?>