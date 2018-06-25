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

$this->title = $model -> title;


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
        <img class="pageBg" src="/frontend/web/common/pages/<?= $model->id.'/'.$model->background ?>" alt="">
    <? endif; ?>
    <? if($fileType == 'video'):  ?>
        <video class="pageBg" src="/frontend/web/common/pages/<?= $model->id.'/'.$model->background ?>" autoplay loop alt="">
        </video>
    <? endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h1><?= $model -> title ?></h1>
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

<?php
echo newerton\fancybox\FancyBox::widget([
    'target' => 'a[class=fancybox]',
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

<section class="pages-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-5 pb-5">
                <?= Alert::widget() ?>
                <?= $model->content ?>
            </div>
        </div>
    </div>
</section>



