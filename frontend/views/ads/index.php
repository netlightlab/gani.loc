<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.04.2018
 * Time: 10:16
 */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->title = 'Объявление пользователя';

?>

<section class="section-header" style="background: url('../common/img/header/parallax-ads.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1>ОБЪЯВЛЕНИЯ!</h1>
                    <p>Объявление пользователей</p>
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
            <?php foreach ($ads as $item): ?>
                <div class="col-md-2 col-sm-2 my-3">
                    <div class="boxAds-hit">
                        <?= Html::a('', ['ads/view', 'id' => $item->id], ['class' => 'tour_link']) ?>
                        <div class="boxAds-img">
                            <?= $item->mini_image ? Html::img('@web/common/users/'.$item->user_id.'/ads/'.$item->mini_image) : Html::img('@web/common/users/no-image.png') ?>
                        </div>
                        <div class="boxAds-info">
                            <span><?= $item->description ?></span>
                        </div>
                        <p class="tel"><?= $item->phone ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
