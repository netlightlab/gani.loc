<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Catalog */

$this->title = 'Баннера';
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
