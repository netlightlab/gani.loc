<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Tours;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments Replies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-reply-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comments Reply', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'tour_id',
                'value' => function($e){
                    return Tours::find()->select(['name'])->where(['id' => $e])->one()->name;
                }
            ],
//            'user_id',
//            'comment_id',
//            'tour_id',
            'comment:ntext',
            'active',
            //'date',
            //'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
