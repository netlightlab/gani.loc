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

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property boolean $paid
 * @property int $sum
 * @property int $qty
 * @property integer $time
 */

class Orders extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'paid' => 'Оплачен',
            'sum' => 'Внесенная сумма',
            'time' => 'Дата оплаты',
        ];
    }

    public function getItems()
    {
        return $this->hasOne(OrderItems::className(), ['order_id' => 'id'])->with('tours')->with('tickets');
    }

    public function getCustomer(){
        return $this->hasOne(User::className(), ['id' => 'user_id'])->select(['id','username','email','user_name','surname','phone'])->asArray();
    }

}