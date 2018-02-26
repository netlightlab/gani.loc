<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2018
 * Time: 10:31
 */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->title = 'Tours';

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
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <h1>FILTER</h1>
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
                                        <option value="1">Казахстан</option>
                                        <option value="2">Россия</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <h1>SORT</h1>
                    </div>
                    <?php foreach($tours as $tour) : ?>
                    <div class="col-md-12 pb-4">
                        <div class="row alltours_box">
                            <div class="col-md-4 col-sm-4 m-0 p-0">
                                <div class="alltours_img-list">
                                    <a href="/tours/view/?id=<?= $tour->id ?>" title="<?= $tour->name ?>"><?= Html::img('@web/common/tour_img/'.$tour->id.'/'.$tour->mini_image) ?></a>
                                    <span>Category</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="alltours_description">
                                    <a href="/tours/view/?id=<?= $tour->id ?>" title="<?= $tour->name ?>"><h3><?= $tour->name ?></h3></a>
                                    <hr>
                                    <span><?= $tour->mini_description ?></span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 py-2">
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
    
    
    getToursCountries.addEventListener('change', function(){
       window.location.href = "search?country_id=" + getToursCountries.options[getToursCountries.selectedIndex].value; 
    });
    
    getToursCategory.addEventListener('change', function(){
       window.location.href = "category_id=" + getToursCategory.options[getToursCategory.selectedIndex].value; 
    });
JS;

$this->registerJs($js);

?>