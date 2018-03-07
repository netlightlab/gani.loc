<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.12.2017
 * Time: 9:39
 */
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Html;

$this->title = $title;


?>

<?/*= Html::img('/frontend/web/common/pages/1/'.$background) */?>
<!--<video autoplay loop src="/frontend/web/common/pages/1/<?/*= $background */?>"></video>-->
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
    <? if($fileType == 'image'): ?>
        <img class="pageBg" src="/frontend/web/common/pages/<?= $pageId.'/'.$background ?>" alt="">
    <? endif; ?>
    <? if($fileType == 'video'):  ?>
        <video class="pageBg" src="/frontend/web/common/pages/<?= $pageId.'/'.$background ?>" autoplay loop alt="">
        </video>
    <? endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2><?= $title ?></h2>
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
                <?= $content ?>
            </div>
        </div>
    </div>
</section>