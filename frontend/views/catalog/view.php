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


$lang = Yii::$app->language;

if($lang === 'ru'){
    $title = $item->title;
    $description = $item->description;
    $keywords = $item->keywords;
}elseif($lang === 'kz'){
    $item->title_kz ? $title = $item->title_kz : $title = $item->title;
    $item->description_kz ? $description = $item->description_kz : $description = $item->description;
    $item->keywords_kz ? $keywords = $item->keywords_kz : $keywords = $item->keywords;
}else{
    $item->title_en ? $title = $item->title_en : $title = $item->title;
    $item->description_en ? $description = $item->description_en : $description = $item->description;
    $item->keywords_en ? $keywords = $item->keywords_en : $keywords = $item->keywords;
}

$this->title = $title;
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);

//$this->title = $item->title;
//$this->registerMetaTag(['name' => 'description', 'content' => $item->description]);
//$this->registerMetaTag(['name' => 'keywords', 'content' => $item->keywords]);

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
    <?= Html::img('/frontend/web/common/catalog/' . $item->id . '/' . $item->image, ['class' => 'pageBg']) ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1><?= $item->name ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: #2e2e2e;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $this->params['breadcrumbs'][] = [
                    'label' => Yii::t('app','Каталог туров'),
                    'url' => \yii\helpers\Url::toRoute('/catalog')
                ]; ?>
                <?php $this->params['breadcrumbs'][] = $item->name; ?>
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
            <div class="col-md-12 pt-5 pb-2">
                <?= Alert::widget() ?>
                <div class="row">
                    <div class="col-md-12">
                        <?= $item->text ?>
                    </div>
                </div>
                <div class="row">
                    <?php if($recomendations): ?>
                        <div class="col-md-12 pb-3">
                            <span class="h4"><?= Yii::t('app', 'Рекомендуемые туры') ?>:</span>
                        </div>
                        <?php foreach($recomendations as $recomendation): ?>
                            <div class="col-md-3">
                                <div class="boxTour-hit">
                                    <?= Html::a('', ['/tours/view', 'id' => $recomendation->id], ['class' => 'tour_link']) ?>
                                    <div class="catalog-img">
                                        <?= Html::img('/frontend/web/common/tour_img/' . $recomendation->id . '/' . $recomendation->mini_image) ?>
                                    </div>
                                    <span class="h5" style="text-align: center;"><?= $recomendation->name ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-md-12 d-flex justify-content-center">
                            <?= Html::a(Yii::t('app', 'Все туры категории'), ['/tours/search', 'filter_categories[]' => $item->recommended], ['class' => 'btn-all']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
