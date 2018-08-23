<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CommentsReply */

$this->title = 'Create Comments Reply';
$this->params['breadcrumbs'][] = ['label' => 'Comments Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-reply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
