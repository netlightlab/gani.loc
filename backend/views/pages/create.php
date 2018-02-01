<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.2017
 * Time: 13:32
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>


<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
