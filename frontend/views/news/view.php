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
    $title = $item->page_title;
    $description = $item->page_description;
    $keywords = $item->page_keywords;
}elseif($lang === 'kz'){
    $item->page_title_kz ? $title = $item->page_title_kz : $title = $item->page_title;
    $item->page_description_kz ? $description = $item->page_description_kz : $description = $item->page_description;
    $item->page_keywords_kz ? $keywords = $item->page_keywords_kz : $keywords = $item->page_keywords;
}else{
    $item->page_title_en ? $title = $item->page_title_en : $title = $item->page_title;
    $item->page_description_en ? $description = $item->page_description_en : $description = $item->page_description;
    $item->page_keywords_en ? $keywords = $item->page_keywords_en : $keywords = $item->page_keywords;
}


$this->title = $title;
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);

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
    <?= Html::img('/frontend/web/common/news/' . $item->id . '/' . $item->image, ['class' => 'pageBg']) ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1><?= $item->title ?></h1>
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
                        'label' => Yii::t('app','Новости'),
                        'url' => \yii\helpers\Url::toRoute('/news')
                ]; ?>
                <?php $this->params['breadcrumbs'][] = $item->title; ?>
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
            <div class="col-md-12 py-5">
                <?= Alert::widget() ?>
                <div class="row">
                    <div class="col-md-12">
                        <?= $item->description ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
