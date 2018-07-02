<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Tours;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comments', ['create'], ['class' => 'btn btn-success']) ?>
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
            'fio',
            'date',
//            'load_photo',
            'active',
            //'user_id',
            //'reviews',
            //'recommendation',
            //'message',
            //'sum_rating',
            //'user_photo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
