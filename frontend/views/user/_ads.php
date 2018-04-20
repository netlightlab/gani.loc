<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.04.2018
 * Time: 11:55
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\Cities;

?>
<?php foreach ($ads as $item): ?>
<div class="my-ads-box mb-3">
    <div class="row">
        <div class="col-md-4">
            <div class="ads-image">
                <?= $item->mini_image ? Html::img('@web/common/users/'.$item->user_id.'/ads/'.$item->mini_image) : Html::img('@web/common/users/no-image.png') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ads-info">
                <p>Телефон: <span><?= $item->phone ?></span></p>
                <span>Описание:<br><?= $item->description ?></span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="ads-group">
                <?= Html::a('Удалить', ['delete', 'id' => $item->id], [
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить?',
                        'method' => 'post',
                    ],
                ]) ?>
                <a href="#asd">Деактивировать</a>
                <?= Html::a('Изменить', ['ads-update', 'id' => $item->id]) ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

