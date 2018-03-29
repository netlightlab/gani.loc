<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.03.2018
 * Time: 12:00
 */

namespace common\models;


use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $order_id
 * @property int $tour_id
 * @property int $sum
 * @property int $qty
 */

class OrderItems extends ActiveRecord
{
    public static function tableName()
    {
        return 'order_items';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Номер заказа',
            'tour_id' => 'ID тура',
            'sum' => 'Сумма',
            'qty' => 'Количество билетов',
        ];
    }
}