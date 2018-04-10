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
use frontend\models\Comments;
use frontend\controllers\ToursController;
use yii\widgets\Pjax;

$this->title = $tour->name;

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
<!--    <div id="map"></div>-->
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
                                                <p><?= $tour->dot_place ?></p>
                                            </div>
                                            <div class="col-md-12">
                                                <h4>Доступные языки тура или развлечения:</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <p><?= $tour->tour_language ?></p>
                                            </div>
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
                            </div>
                            <div id="reviews" class="tab-pane">
                                <? foreach($comments as $comment) :?>
                                    <articles class="row comments_tour">
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
                                        </div>
                                    </articles>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <? if($isauthorize): ?>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <?php $form = ActiveForm::begin(['id' => 'form-review', 'method' => "POST", "action" => ""]); ?>
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
                            <div class="col-md-4">
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



                    <? $form = ActiveForm::begin(['method' => "POST", "action" => "/orders/index"]); ?>
                    <?= Html::submitButton('купить', ['class' => 'btn_map', 'style' => 'background: #ec3e3e', 'name' => 'tour_id', 'value' => $_GET['id'], 'type' => 'submit']) ?>
                    <?php ActiveForm::end(); ?>



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
                    <?= Html::input('hidden', 'tour_id', $_GET['id']) ?>
                    <?= Html::submitButton('добавить в корзину',['class' => 'btn_map', 'style' => 'background: #ec3e3e']) ?>
                    <?php ActiveForm::end(); ?>





                    <div class="offer-company_details">
                        <div class="offer-company_header">
                            <?= $user['user_photo'] ? Html::img('@web/common/users/'.$user['id'].'/'.$user['user_photo']) : Html::img('@web/common/users/no-image.png') ?>
                        </div>
                        <div class="offer-company_content">
                            <span>Компания:</span>
                            <h5><?= $user->name_company ?></h5>
                            <?= Html::a('Другие объявления от компании', ['site/index'], ['class' => 'allTours_author']) ?>
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
            $("#form-review").html('<h2 class="reviews_success">Спасибо, Ваш отзыв отправлен на проверку модератору!</h2>');
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
                console.log(response);
                $('#addToCart button').text('Добавлено');
            }
        });
        return false;
    });
    
       
JS;

$this->registerJs($script);

?>