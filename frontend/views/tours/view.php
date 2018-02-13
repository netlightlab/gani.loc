<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2018
 * Time: 10:31
 */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->title = $tour->name;

?>

<!--<section class="section-header" style="background: url('../common/img/header/parallax-partner-cabinet.jpg')">-->
<section class="section-header" style="background: url('../common/tour_img/<?= $tour->id ?>/<?= $tour->back_image?>')">
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
    <div id="map"></div>
</div>
<div style="background: #f9f9f9;">
    <div class="container">
        <div class="row py-5">
            <section id="single_tour_desc" class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <h3>Подробное описание</h3>
                    </div>
                    <div class="col-md-9">
                        <h4><?= $tour->name ?></h4>
                        <p><?= $tour->description ?></p>
                        <hr>
                        <h4>Места посещения:</h4>
                        <hr>
                        <h4>Места посещения:</h4>
                        <hr>
                        <h4>Доступные языки тура или развлечения:</h4>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Подробное описание</h3>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-bordered table-tour-price">
                            <thead>
                            <tr>
                                <th>Тип билета</th>
                                <th>Возраст</th>
                                <th>Цена</th>
                                <th>Цена со скидкой</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Стандартный</td>
                                <td>-</td>
                                <td><?= $tour->price ?><span>₸</span></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Расписание</h3>
                    </div>
                    <div class="col-md-9">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Условия покупки</h3>
                    </div>
                    <div class="col-md-9">
                        <?= $tour->return_cond ?>
                    </div>
                </div>
            </section>
            <aside class="col-md-4">
                <div class="hidden_map">
                    <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="true" aria-controls="collapseMap">ПОКАЗАТЬ ТОЧКУ СБОРА</a>
                </div>
            </aside>
        </div>
    </div>
</div>
