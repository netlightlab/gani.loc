<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.04.2018
 * Time: 10:16
 */

use yii\widgets\Breadcrumbs;

$this->title = 'Объявление пользователя';

?>

<section class="section-header" style="background: url('../common/img/header/parallax-ads.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>ПРИВЕТСТВУЮ!</h2>
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
        <div class="row">
            <div class="col-md-12">
                .
            </div>
        </div>
    </div>
</section>

<?php print_r($ads) ?>
