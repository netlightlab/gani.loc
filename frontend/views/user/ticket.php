<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.04.2018
 * Time: 11:04
 */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->title = 'Билеты';

?>

<section class="section-header" style="background: url('../common/img/header/profile.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>ПРИВЕТСТВУЕМ ВАС <?= Yii::$app->user->identity->username ?>!</h2>
                    <p>Это Ваш личный кабинет. Здесь вы можете отслеживать статус своего заказа, просматривать список желаний и менять сведения о себе</p>
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

<section class="pt-5 pb-5" style="background: #f9f9f9;" id="ticket-data">
    <div class="container">
        <div class="row py-3" style="background: #fff; border: 1px solid #ddd;">
            <div class="col-md-12">
                <h1 align="center"><?= Html::img('@web/common/img/header/logo_ticket.png' ) ?></h1>
            </div>
            <div class="col-md-5 my-3">
                <table width="100%" class="tour_info">
                    <tbody>
                    <tr>
                        <td><p><b>Тур</b>:</p></td>
                        <td><span><?= $item->tour_name ?></span></td>
                    </tr>
                    <tr>
                        <td><p><b>от</b>:</p></td>
                        <td><span><?= $item->company_name ?></span></td>
                    </tr>
                    <tr>
                        <td><p><b>Количество билетов</b>:</p></td>
                        <td><span><?= $item->qty ?></span></td>
                    </tr>
                    <tr>
                        <td><p><b>Сумма</b>:</p></td>
                        <td><span><?= $item->price ?></span> ₸.</td>
                    </tr>
                    <tr>
                        <td><p><b>Номер вашего сертификата</b>:</p></td>
                        <td><span><strong><?= $item->certificate ?></strong></span></td>
                    </tr>
                    <tr>
                        <td><p><b>Номер заказа</b>:</p></td>
                        <td><span><?= $item->order_num ?></span></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-7 my-3">
                <div class="box">
                    <input type="text" style="display: none;" id="hidden_placeId" value="<?= $tour->dot_place ?>">
                    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
                    <div id="map"></div>
                </div>
            </div>
            <div class="col-md-12">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td>
                            <span style="text-align: left;"><?= $tour->mini_description ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mt-3">
                <p align="center">© Eltourism.kz 2016 - 2018</p>
            </div>
            <div class="col-md-12">
                <p align="right"><a id="zxc" title="Распечатать проект">Распечатать</a></p>
            </div>
        </div>
    </div>
</section>
<?php

$script = <<<JS
    
        var zxc = $('#zxc');
        zxc.on('click', function(){
            var prtContent = document.getElementById('ticket-data'); 
            // var prtCSS = '<link rel="stylesheet" href="/templates/css/template.css" type="text/css" />'; 
            var WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0'); 
            WinPrint.document.write('<div id="print" class="contentpane">'); 
            // WinPrint.document.write(prtCSS); 
            WinPrint.document.write(prtContent.innerHTML); 
            WinPrint.document.write('</div>'); 
            WinPrint.document.close(); 
            WinPrint.focus(); 
            WinPrint.print(); 
            WinPrint.close(); 
            // prtContent.innerHTML=strOldOne;  
        });
        
ymaps.ready(init);

async function init() {
    var getCoordinat = $('#hidden_placeId').val();
    var myCoords = getCoordinat.split(',');
    
    var myPlacemark,
        myMap = new ymaps.Map('map', {
            center: [myCoords[0], myCoords[1]],
            zoom: 16
        }, {
            searchControlProvider: 'yandex#search'
        });
    
    myMap.behaviors.disable('scrollZoom'); 
    
     myPlacemark = createPlacemark([myCoords[0], myCoords[1]]);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
            getAddress(getCoordinat);

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
            $('#dot_placeAddr').val(firstGeoObject.getAddressLine());
            $('#hidden_placeId').val(coords);            
        });
    }
}
JS;

$this->registerJs($script);

?>


