<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ads', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'value' => function($e){
                    return \common\models\User::find()->select(['email'])->where(['id' => $e])->one()->email;
                }
            ],
            [
                'attribute' => 'title',
            ],
//            'phone',
//            'description',
//            'description_en',
            //'mini_image',
            //'gallery',
            //'active',
            //'title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
