<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.03.2018
 * Time: 12:00
 */

namespace common\models;


use frontend\models\Tours;
use yii\base\Model;
use yii\db\ActiveRecord;
use common\models\Tickets;

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

    public function getTours()
    {
        return $this->hasOne(Tours::className(), ['id' => 'tour_id'])->select(['id','name','mini_image']);
    }
    public function getTickets()
    {
        return $this->hasOne(Tickets::className(), ['tour_id' => 'tour_id', 'order_num' => 'order_id'])->asArray();
    }
    public function getOrderInfo(){
        return $this->hasOne(Orders::className(), ['id' => 'order_id'])->with('customer')->asArray();
    }
    public function getCustomer(){
//        return $this->hasOne(User::className(), ['id' => $this->getOrderInfo()->select('user_id')->asArray()->one()]);
//        print_r($this->getOrderInfo()->select('user_id')[0]);
    }
}