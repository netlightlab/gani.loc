<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.04.2018
 * Time: 11:28
 */

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Html;

$this->title = 'Поиск'
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

<!--background: url('/frontend/web/common/pages/<?/*= $pageId .'/'.$background */?>')-->


<section class="section-header" style="">
    <?= Html::img('/frontend/web/common/img/header/ms.jpg', ['class' => 'pageBg']) ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1><?= $this->title ?></h1>
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

<section class="pages-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-5 pb-5">
                <?= Alert::widget() ?>
                <?php if($data): ?>
                    <?php if($data['tours']): ?>
                        <div class="row">
                            <div class="col-md-12 pb-2">
                                <h3>Туры:</h3>
                            </div>
                            <?php foreach($data['tours'] as $item): ?>
                                <div class="col-md-3">
                                    <div class="boxTour-hit">
                                        <?= Html::a('', ['/tours/view', 'id' => $item['id']], ['class' => 'tour_link']) ?>
                                        <div class="catalog-img">
                                            <?= Html::img('/frontend/web/common/tour_img/'. $item['id'] . '/' . $item['mini_image']) ?>
                                        </div>
                                        <h5><?= $item['name'] ?></h5>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if($data['catalog']): ?>
                        <div class="row">
                            <div class="col-md-12 py-2">
                                <h3>Каталог:</h3>
                            </div>
                            <?php foreach($data['catalog'] as $item): ?>
                                <div class="col-md-3">
                                    <div class="boxTour-hit">
                                        <?= Html::a('', ['/catalog/view', 'id' => $item['id']], ['class' => 'tour_link']) ?>
                                        <div class="catalog-img">
                                            <?= Html::img('/frontend/web/common/catalog/'. $item['id'] . '/' . $item['image']) ?>
                                        </div>
                                        <h5><?= $item['name'] ?></h5>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if($data['page']): ?>
                        <div class="row">
                            <div class="col-md-12 py-2">
                                <h3>Страницы:</h3>
                            </div>
                            <?php foreach($data['page'] as $item): ?>
                                <div class="col-md-12">
                                    <?= Html::a($item['title'], ['/page', 'id' => $item['id']]) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <h2>К сожалению по вашему запросу ничего не найдено</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
