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
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Categories;

$this->title = 'Поиск';
$category = new Categories();

?>

<section class="section-header" style="background: url('../common/img/header/parallax-alltours.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1>ПОИСК</h1>
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
                    <?php
                    /*Pjax::widget([
                        'id' => 'searchContainer',  // response goes in this element
                        'enablePushState' => true,
                        'enableReplaceState' => false,
                        'formSelector' => '#ts_form',// this form is submitted on change
                        'submitEvent' => 'change',
                    ]);*/
                    ?>
                    <div id="places">
                        <?php Pjax::begin([
                            'id' => 'searchContainer',
                            'formSelector' => '#filterForm',
                            'linkSelector' => '#lll',
                            'enablePushState' => true,
                            'options' => [
                                    'data-pjax-timeout' => 10000
                            ]
                        ]) ?>
                        <p>Найдено туров: <?= count($tours) ?></p>
                        <?php foreach($tours as $tour) : ?>
                            <div class="alltours_box">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="alltours_img-list">
                                            <?= Html::a(Html::img('@web/common/tour_img/'.$tour->id.'/'.$tour->mini_image), ['/tours/view', 'id' => $tour->id]) ?>
                                            <span><?= $category->getCategoryName($tour->category_id) ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="alltours_description">
                                            <?= Html::a('<p class="h3">'.$tour->name.'</p>', ['/tours/view/', 'id' => $tour->id]) ?>
                                            <span><?= $tour->mini_description ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="alltours_price-list">
                                            <small>от <?= $tour->price ?> ₸</small>
                                            <?= Html::a('подробнее', ['/tours/view/', 'id' => $tour->id], ['class' => 'alltours_btn-info']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                        <?php Pjax::end() ?>
                    </div>
                </div>
                <aside class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hidden_map">
                                <a class="btn_map collapsed" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">ПОКАЗАТЬ НА КАРТЕ</a>
                            </div>
                        </div>
                        <div class="col-md-12 py-3">
                            <div id="filter">
                                <a class="filter_show collapsed" data-toggle="collapse" href="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><img src="/common/filters/loupe.png" >Фильтр</a>
                                <div class="collapse" id="collapseFilter" aria-expanded="false" style="height: 0px;">
                                    <!--<div class="filter-block">
                                        <h6>Выберите страну</h6>
                                        <select id="getToursCountries">
                                            <option> </option>
                                            <option value="1">Казахстан</option>
                                            <option value="2">Россия</option>
                                        </select>
                                    </div>-->
                                    <?= $this->render('_filter', [
                                        'search_form' => $search_form,
                                        'tours' => $tours,
                                        'formParams' => $formParams,
                                        'categories' => $categories
                                    ]) ?>
                                </div>
                            </div>
                           
  
                        </div>
                        <?php if($banner): ?>
                            <div class="col-md-12 text-center">
                                <?= Html::a(Html::img('@web/common/banners/'.$banner->id.'/'.$banner->banner, ['style' => 'max-width: 100%']),$banner->link,['target' => 'blank']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </aside>
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
