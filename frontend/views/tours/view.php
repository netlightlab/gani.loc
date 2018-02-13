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
                    <p><?= $tour->price ?>₸</p>
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

<section>
    <div class="container">

    </div>
</section>