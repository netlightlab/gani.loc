<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.02.2018
 * Time: 10:31
 */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->title = 'Tours';

?>

<section class="section-header" style="background: url('../common/img/header/parallax-partner-cabinet.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>ПРИВЕТСТВУЕМ!</h2>
                    <p>Личный кабинет тур компаний <?= $UsersInfo['name_company'] ?></p>
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

<section>
    <div class="container">
        <div class="row">
            <?php foreach ($tours as $tour) : ?>
                <div class="col-md-4">
                    <?= $tour->name ?>
                    <?= Html::a('Подробнее', ['/tours/view/','id' => $tour->id]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>