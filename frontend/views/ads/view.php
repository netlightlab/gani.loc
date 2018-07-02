<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.04.2018
 * Time: 10:16
 */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

\Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => strip_tags($ads->description),
]);

$this->title = $ads->title;

?>

<section class="section-header" style="background: url('../common/img/header/parallax-ads.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1><?= $ads->title ?></h1>
                    <p>Объявление от полльзователя "<b><?= $user['user_name'] ?></b>"</p>
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
        <div id="ads-view" class="row">
            <div class="col-md-4">
                <div class="ads-view_image">
                    <?= $ads->mini_image ? Html::img('@web/common/users/'.$ads->user_id.'/ads/'.$ads->mini_image) : Html::img('@web/common/users/no-image.png') ?>
                </div>
            </div>
            <div class="col-md-8">
                <span class="h4"><?= Yii::t('app', 'Номер телефона') ?>:</span>
                <p><b><?= $ads->phone ?></b></p>
                <span class="h4"><?= Yii::t('app', 'Описание') ?>:</span>
                <p><?= $ads->body ?></p>
            </div>
            <div class="col-md-12">
                <span class="h4">Галерея фотографии:</span>
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
                <?php if ($gallery):?>
                    <hr class="tourLine">
                    <div class="tour_gallery">
                        <?php foreach ($gallery as $item): ?>
                            <div class="tour_gallery-thumb">
                                <?= Html::a(Html::img('@web/common/users/'.$ads->user_id.'/ads/'.$item), '@web/common/users/'.$ads->user_id.'/ads/'.$item, ['class' => 'fancybox', 'rel' => 'fancybox']); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
