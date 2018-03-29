<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.03.2018
 * Time: 9:37
 */

$this->title = 'Оплата';

use yii\helpers\Html;
use common\widgets\Alert;

?>

<div style="height:200px;"></div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?= Alert::widget() ?>
        </div>
    </div>
</div>

<? print_r($orders) ?>
