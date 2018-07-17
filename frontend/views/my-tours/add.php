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


$alias = Yii::getAlias('@web');

$this->title = 'Создание тура';
?>

<section class="section-header" style="background: url('<?= $alias ?>/common/img/header/parallax-addtour.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1>Воплощение идеи</h1>
                    <p>Здесь вы можете разместить ваш тур/развлечение</p>
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
            'url'       : '/my-tours/add',
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
    var myPlacemark,
        myMap = new ymaps.Map('map', {
            // center: [56,36],
            center: [43.19635166998611,76.97155513789725],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        });
        
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