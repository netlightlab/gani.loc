<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.04.2018
 * Time: 10:32
 */

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Html;

?>

<style>
    .pageBg {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .section-header {
        overflow: hidden;
    }
</style>

<section class="section-header" style="">
    <?= Html::img('/frontend/web/common/img/header/ms.jpg', ['class' => 'pageBg']) ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1><?= Yii::t('app', 'Новости') ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: #2e2e2e;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $this->params['breadcrumbs'][] = Yii::t('app', 'Новости'); ?>
                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => Yii::t('app', 'Главная'),
                        'url' => Yii::$app->homeUrl,
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
    </div>
</section>

<section class="pages-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-5 pb-5">
                <?= Alert::widget() ?>
                <div class="row">
                    <?php if($items): ?>
                        <?php foreach($items as $item): ?>
                            <div class="col-md-3">
                                <div class="boxTour-hit">
                                    <?= Html::a('', \yii\helpers\Url::to(['/news/view', 'id' => $item->url ? $item->url : $item->id]), ['class' => 'tour_link']) ?>
                                    <div class="news-date"><span><?= Yii::t('app', 'Опубликован') ?>: <strong><?= $item->date ?></strong></span></div>
                                    <div class="catalog-img">
                                        <?= Html::img('/frontend/web/common/news/' . $item->id . '/' . $item->image) ?>
                                    </div>
                                    <span class="h5" style="text-align: center;"><?= $item->title ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
