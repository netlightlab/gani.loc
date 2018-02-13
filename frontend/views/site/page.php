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

<section class="section-header" style="background: url('/backend/web/uploads/page/<?= $background ?>')">
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