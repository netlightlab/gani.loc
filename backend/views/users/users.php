<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.11.2017
 * Time: 18:01
 */

use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-6">
            Login
        </div>
        <div class="col-xs-6">
            actions
        </div>
        <? foreach($users as $user){ ?>
            <div class="col-xs-6">
                <?= Html::a($user['username'], ["users/edit", "id" => $user['id']]) ?>
            </div>
            <div class="col-xs-6">
                &nbsp;
            </div>
        <? } ?>
    </div>
</div>
