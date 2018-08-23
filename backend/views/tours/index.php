<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use richardfan\sortable\SortableGridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'sortUrl' => Url::to(['sort-item']),
        'columns' => [

            'id',
            'name',
            [
                'attribute' => 'user_id',
                'format' => 'text',
                'value' => function($model){
                    return $model->getTourUser();
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>