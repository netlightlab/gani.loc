<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.04.2018
 * Time: 11:55
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\Cities;

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = 'Мои объявления'

?>
    <section class="section-header" style="background: url('../common/img/header/profile.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="parallax-header-text">
                        <h2>ПРИВЕТСТВУЕМ ВАС <?= Yii::$app->user->identity->username ?>!</h2>
                        <p>Это Ваш личный кабинет. Здесь вы можете отслеживать статус своего заказа, просматривать список желаний и менять сведения о себе</p>
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
                    <?= Alert::widget() ?>
                    <ul id="w2" class="cabinet-nav nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="#rus" data-toggle="tab" aria-expanded="true"><span>РУССКИЙ</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="#kaz" data-toggle="tab" aria-expanded="true"><span>ҚАЗАҚША</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="#eng" data-toggle="tab" aria-expanded="true"><span>ENGLISH</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="rus" class="tab-pane set-tab-content active">
                            <?= $this->render('_form', [
                                'model' => $model,
                            ]) ?>
                        </div>
                        <div id="kaz" class="tab-pane set-tab-content">
                            <span style="color: red;">Whoops page is not working!</span>
                        </div>
                        <div id="eng" class="tab-pane set-tab-content">
                            <span style="color: red;">Whoops page is not working!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>