<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CommentsReply */

$this->title = 'Update Comments Reply: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Comments Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comments-reply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
