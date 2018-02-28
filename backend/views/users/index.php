<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <?/*= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'email',
            [
                'attribute' => 'role',
                'format' => 'text',
                'value' => function($model){
                    return $model->role == 'partner' ? 'Партнер' : 'Пользователь';
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function($model){
                    return $model->status == 1 ? 'Активен' : 'Неактивен';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
