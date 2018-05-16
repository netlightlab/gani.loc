<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2018
 * Time: 10:31
 */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Categories;

$this->title = $tour->name;

$category = new Categories();

?>

<?= $tour->back_image ? "<section class='section-header' style='background: url(../common/tour_img/".$tour->id. "/" . $tour->back_image ."')>" : "<section class='section-header' style='background: url(../common/users/no-image.png) no-repeat center; background-size: contain !important'".">" ?>
    <div class="parallax-tour">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 parallax-tour-description">
                    <h1><?= $tour->name ?></h1>
                    <span><?= $tour->official_name ?></span>
                </div>
                <div class="col-md-4 col-sm-4 parallax-tour-price">
                    <p><?= $tour->price ?><span>₸</span></p>
                    <span>*на человека</span>
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
<div class="collapse" id="collapseMap" aria-expanded="false" style="height: 0px;">
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <div id="map"></div>
</div>

<div style="background: #f9f9f9;">
    <div class="container">
        <div class="row py-5">
            <main id="single_tour_desc" class="col-md-8">
                <div id="single-fix" class="row">
                    <div class="col-md-12">
                        <ul id="w1" class="nav view_tour-tabs">
                            <li><a class="tab-link active" href="#info" data-toggle="tab" aria-expanded="true"><span>Информация</span></a></li>
                            <li><a class="tab-link" href="#reviews" data-toggle="tab" aria-expanded="true"><span>Отзывы ( <?= $reviews_count ?> )</span></a></li>
                        </ul>
                        <div class="tab-content view_tour_content">
                            <div id="info" class="tab-pane active">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Подробное описание</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4><?= $tour->name ?></h4>
                                            </div>
                                            <div class="col-md-12 my-3">
                                                <?= $tour->description ?>
                                            </div>
                                            <div class="col-md-12">
                                                <h4>Точка сбора:</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <p><?= $tour->dot_place_addr ?></p>
                                            </div>
                                            <div class="col-md-12">
                                                <h4>Доступные языки тура или развлечения:</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <p><?= $tour->tour_language ?></p>
                                            </div>
                                            <div class="col-md-12" style="display: none;">
                                                <div style="display: none;">
                                                    <input type="text" id="hidden_placeId" value="<?= $tour->dot_place ?>">
                                                </div>
                                            </div>
                                            <?php if ($tour->w_included): ?>
                                            <div class="col-md-12">
                                                <h4>Что входит в тур:</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <p><?= $tour->w_included ?></p>
                                            </div>
                                            <?php endif; ?>
                                            <?php if ($gallery):?>
                                            <div class="col-md-12">
                                                <h4>Галерея фотографии:</h4>
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
                                                    <hr class="tourLine">
                                                    <div class="tour_gallery">
                                                        <?php foreach ($gallery as $item): ?>
                                                            <div class="tour_gallery-thumb">
                                                                <?= Html::a(Html::img('@web/common/tour_img/'.$tour->id.'/'.$item), '@web/common/tour_img/'.$tour->id.'/'.$item, ['rel' => 'fancybox']); ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                            </div>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Цены</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><?= $tour->price ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php if ($tour->conditions): ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Условия покупки</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><?= $tour->conditions ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php endif; ?>
                                <?php if ($tour->return_cond): ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Условия возврата</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><?= $tour->return_cond ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Категория тура</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><?= $category->getCategoryName($tour->category_id) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="reviews" class="tab-pane">
                                <?php if ($comments): ?>
                                <?php
                                echo newerton\fancybox\FancyBox::widget([
                                    'target' => 'a[rel=commentBox]',
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
                                <? foreach($comments as $comment) :?>
                                    <article class="row comments_tour">
                                        <div class="col-md-3">
                                            <p style="font-size: 16px;"><?= $comment->fio ?></p>
                                            <div class="comment_user_photo"><?= $comment['user_photo'] ? Html::img('@web/common/users/'.$comment['user_id'].'/'.$comment['user_photo']) : Html::img('@web/common/users/no-image.png') ?></div>
                                            <div class="rating">
                                                <div class="rating_reviews"></div>
                                                <div id="ratingBar" style="width: <?= $comment->reviews?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <span><?= $comment->message ?></span>
                                            <p><?= $comment->date ?></p>
                                            <?php if ($comment['load_photo']):?>
                                                <hr class="commentsLine">
                                                <div class="comments_gallery">
                                                <?php foreach (explode(',', $comment['load_photo']) as $item): ?>
                                                    <div class="comments_gallery-thumb">
                                                        <?= Html::a(Html::img('@web/common/users/'.$comment['user_id'].'/'.$item), '@web/common/users/'.$comment['user_id'].'/'.$item, ['rel' => 'commentBox']); ?>
                                                    </div>
                                                <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </article>
                                <? endforeach; ?>
                            </div>
                        <?php else: ?>
                            <h4 align="center">В данном туре отзывы отсутствуют, <span><b>будьте первыми!</b></span></h4>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <? if($isauthorize): ?>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <?php $form = ActiveForm::begin(['id' => 'form-review', "action" => "", "options" => ['ecntype' => 'multipart/form-data']]); ?>
                        <h5>Оставить отзыв</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rating_click">
                                    <?= Html::a(Html::img(["@web/common/img/tour-hit/likes.png"]), '#', ['id' => 1, 'data-value_rating' => "20"]) ?>
                                    <?= Html::a(Html::img(["@web/common/img/tour-hit/likes.png"]), '#', ['id' => 2, 'data-value_rating' => "40"]) ?>
                                    <?= Html::a(Html::img(["@web/common/img/tour-hit/likes.png"]), '#', ['id' => 3, 'data-value_rating' => "60"]) ?>
                                    <?= Html::a(Html::img(["@web/common/img/tour-hit/likes.png"]), '#', ['id' => 4, 'data-value_rating' => "80"]) ?>
                                    <?= Html::a(Html::img(["@web/common/img/tour-hit/likes.png"]), '#', ['id' => 5, 'data-value_rating' => "100"]) ?>
                                    <div id="ratingBarClick"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'message')->textarea(['placeholder' => 'Максимум 1000 символов', 'rows' => '5', 'required' => 'true'])->label('')?>
                                <div style="display: none;"><?= $form->field($model, 'reviews')->textInput(['id' => 'rev_db', 'value' => '60']) ?></div>
                            </div>
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12">
                                <?php
                                echo \kato\DropZone::widget([
                                    'options' => [
                                        'maxFilesize' => 10,
                                        'maxFiles' => 10,
                                        'url' => '/tours/view?id='.Yii::$app->request->get('id'),
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
                            <div class="col-md-4 mt-3">
                                <?= Html::submitButton('Отправить', ['class' => 'btn_map', 'name' => 'submit']) ?>
                            </div>
                            <div class="col-md-12 my-4">
                                <span style="color: red;">Важно!!</span>
                                <span>Данный отзыв будет рассмотрен модератором, после чего он появиться на сайте!</span>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <? endif; ?>
            </main>
            <aside class="col-md-4">
                <div id="sidebar">
                    <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="true" aria-controls="collapseMap">ПОКАЗАТЬ ТОЧКУ СБОРА</a>
                    <? $form = ActiveForm::begin([
                        'method' => "POST",
                        'id' => 'addPost',
                        'enableAjaxValidation' => true,
                        'action' => '',
                        'options' => [
                            'data-pjax' => true,
                            'enctype' => 'multipart/form-data'
                        ]
                    ]); ?>
                    <?= Html::input('hidden', 'tour_id', (int)Yii::$app->request->get('id')) ?>
                    <?= Html::submitButton('Купить',['class' => 'btn_map', 'style' => 'background: #ec3e3e']) ?>
                    <?php ActiveForm::end(); ?>
<!--                    --><?// $form = ActiveForm::begin(['method' => "POST", "action" => "/cart/index"]); ?>
<!--                    --><?//= Html::submitButton('купить', ['class' => 'btn_map', 'style' => 'background: #ec3e3e', 'name' => 'tour_id', 'value' => $_GET['id'], 'type' => 'submit']) ?>
<!--                    --><?php //ActiveForm::end(); ?>
                    <? $form = ActiveForm::begin([
                            'method' => "POST",
                            'id' => 'addToCart',
                            'enableAjaxValidation' => true,
                            'action' => '',
                            'options' => [
                                    'data-pjax' => true,
                                    'enctype' => 'multipart/form-data'
                            ]
                    ]); ?>
                    <?= Html::input('hidden', 'tour_id', (int)Yii::$app->request->get('id')) ?>
                    <?= Html::submitButton('добавить в корзину',['class' => 'btn_map', 'style' => 'background: #ec3e3e']) ?>
                    <?php ActiveForm::end(); ?>
                    <div class="offer-company_details">
                        <div class="offer-company_header">
                            <?= $user['user_photo'] ? Html::img('@web/common/users/'.$user['id'].'/'.$user['user_photo']) : Html::img('@web/common/users/no-image.png') ?>
                        </div>
                        <div class="offer-company_content">
                            <span>Компания:</span>
                            <h5><?= $user->name_company ?></h5>
                            <?= Html::a('Другие объявления от компании', ['/tours/search/', 'user_id' => $user->id], ['class' => 'allTours_author']) ?>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<?php

$script = <<<JS
    $(document).ready(function() {
       $('#ratingBarClick').css({width: 60+'%'});
        var myAction = function(response){
           console.log(response);
       };
      
    });
    $(document).hover(function () {
        $("#1").hover(function () {
            $("#ratingBarClick").css({width: $("#1").attr("data-value_rating") + "%"});
            $("#rev_db").val($(this).attr("data-value_rating"));
        });
        $("#2").hover(function () {
            $("#ratingBarClick").css({width: $("#2").attr("data-value_rating") + "%"});
            $("#rev_db").val($(this).attr("data-value_rating"));
        });
        $("#3").hover(function () {
            $("#ratingBarClick").css({width: $("#3").attr("data-value_rating") + "%"});
            $("#rev_db").val($(this).attr("data-value_rating"));
        });
        $("#4").hover(function () {
            $("#ratingBarClick").css({width: $("#4").attr("data-value_rating") + "%"});
            $("#rev_db").val($(this).attr("data-value_rating"));
        });
        $("#5").hover(function () {
            $("#ratingBarClick").css({width: $("#5").attr("data-value_rating") + "%"});
            $("#rev_db").val($(this).attr("data-value_rating"));
        });
    });    
    $("#form-review").on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        var photos = [];
        $.each(myDropzone.files, function(index, value) {
          photos.push(value.name);
        }) ;
        form += "&Comments%5Bload_photo%5D="+photos;
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
            $("#form-review").html('<p class="reviews_success">Спасибо, Ваш отзыв отправлен на проверку модератору!</p>');
            myDropzone.processQueue();
          });
        return false;
    });
    $('#addToCart').on('beforeSubmit', function(){
        var form = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/cart/add',
            data: form,
            success: function(response){
                $('#addToCart button').text('Добавлено');
            }
        });
        return false;
    });
    
     $('#addPost').on('beforeSubmit', function(){
        var form = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/cart/add-post',
            data: form
        });
        return false;
    });
     
     var fx_head = 0;
     
     $(".btn_map").click(function() {        
        if(!$("div.collapse").hasClass('show')) {
            fx_head += 350;
        } else {
            fx_head -= 350;
        }
     });
    
     $(document).ready(function () {
        if($(window).width() >= 768) {
            var fx_stop = $("#single-fix").outerHeight();
            var fx_height = $("#sidebar").outerHeight();
            
            $(".tab-link").hover( function () {
                fx_stop = $("#single-fix").outerHeight();
            });
            
            if ($(document).scrollTop() >= 400) {
                $("#sidebar").css({top: $(document).scrollTop() - 400});
                if ($("#sidebar").offset().top >= fx_stop) {
                    $("#sidebar").css({top: fx_stop - fx_height});
                }
            } else {
                $("#sidebar").css({top: 0});
            }
            
             $(document).scroll(function () {
                var top = $(document).scrollTop();
                var sidebar = fx_head+400;
                if (top >= sidebar) {
                    $("#sidebar").css({top: top - sidebar});
                    if ($("#sidebar").offset().top-100 >= fx_stop+fx_head) {
                        $("#sidebar").css({top: fx_stop - fx_height});
                    }
                } else {
                    $("#sidebar").css({top: 0});
                }
            });
        }
    });

ymaps.ready(init);

function init() {
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