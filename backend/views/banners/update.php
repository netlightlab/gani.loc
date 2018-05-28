<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banners */

$this->title = 'Изменить баннер';
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cities-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
