<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.02.2018
 * Time: 17:10
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Поиск';

?>

<section class="section-header" style="background: url('../common/img/header/parallax-alltours.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>ПОИСК</h2>
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

<section class="collapse" id="collapseMap" aria-expanded="false" style="height: 0px;">
    <div id="map"></div>
</section>

    <section style="background: #fbfbfb;">
        <div class="container py-5">
            <div class="row">
                <aside class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hidden_map">
                                <a class="btn_map collapsed" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">ПОКАЗАТЬ НА КАРТЕ</a>
                            </div>
                        </div>
                        <div class="col-md-12 py-3">
                            <div id="filter">
                                <a class="filter_show collapsed" data-toggle="collapse" href="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><img src="/common/filters/nut-icon.png" >Поиск по фильтру</a>
                                <div class="collapse" id="collapseFilter" aria-expanded="false" style="height: 0px;">
                                    <div class="filter-block">
                                        <h6>Выберите страну</h6>
                                        <select id="getToursCountries">
                                            <option> </option>
                                            <option value="1">Казахстан</option>
                                            <option value="2">Россия</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="col-md-9">
                    <div id="sort">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <div class="sort-block">
                                    <select name="sort_price" id="sort_price">
                                        <option value selected>По цене</option>
                                        <option value="price">Самые дешевые</option>
                                        <option value="-price">Самые дорогие</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="places">
                        <?php foreach($model as $tour) : ?>
                            <div class="alltours_box">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="alltours_img-list">
                                            <a href="/tours/view/?id=<?= $tour->id ?>" title="<?= $tour->name ?>"><?= Html::img('@web/common/tour_img/'.$tour->id.'/'.$tour->mini_image) ?></a>
                                            <span>Category</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="alltours_description">
                                            <a href="/tours/view/?id=<?= $tour->id ?>" title="<?= $tour->name ?>"><h3><?= $tour->name ?></h3></a>
                                            <span><?= $tour->mini_description ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="alltours_price-list">
                                            <small>от <?= $tour->price ?> ₸</small>
                                            <a class="alltours_btn-info" href="/tours/view/?id=<?= $tour->id ?>" title="<?= $tour->name ?>">подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php

$js = <<<JS
    var getToursCountries = document.getElementById('getToursCountries');
    var getToursCategory = document.getElementById('getToursCategory');
    var getSortPrice = document.getElementById('sort_price');
    
    var currentURL = window.location.href.toString().split(window.location.host+'/tours/')[1];
    
    getSortPrice.addEventListener('change', function(){
        window.location.href = currentURL + getSortPrice.options[getSortPrice.selectedIndex].value;
    });    
    
    getToursCountries.addEventListener('change', function(){
        window.location.href = currentURL + 'category_id=' + getToursCountries.options[getToursCountries.selectedIndex].value; 
    });
    
    getToursCategory.addEventListener('change', function(){
        window.location.href = currentURL + getToursCategory.options[getToursCategory.selectedIndex].value; 
    });

JS;

$this->registerJs($js);

?>