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


$this->title = $item->title;
$this->registerMetaTag(['name' => 'description', 'content' => $item->description]);

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
                    <h2><?= $item->title ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: #2e2e2e;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $this->params['breadcrumbs'][] = 'Новость'; ?>
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
