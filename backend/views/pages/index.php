<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.2017
 * Time: 13:18
 */
use yii\helpers\Html;
?>
<?= Html::a("Создать", ["pages/create"]) ?>
<? foreach($links as $link): ?>
    <?= Html::a($link['title'], ['pages/edit', 'id' => $link['id']]) ?>
<? endforeach; ?>
