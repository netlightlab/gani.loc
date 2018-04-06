<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.04.2018
 * Time: 16:56
 */

namespace common\models;


use frontend\models\Tours;
use yii\base\Model;
use yii\db\ActiveRecord;
use common\models\Orders;
use common\models\OrderItems;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $tour_name
 * @property string $company_name
 * @property string $certificate
 * @property int $order_num
 * @property int $price
 * @property int $qty
 */
class Tickets extends ActiveRecord
{
    public $randomInt;

    public static function tableName()
    {
        return 'tickets';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tour_name' => 'Название тура',
            'company_name' => 'Название компании',
            'certificate' => 'Номер билета',
            'order_num' => 'Номер заказа',
            'tour_id' => 'Номер тура',
            'price' => 'Цена',
            'qty' => 'Количество персон'
        ];
    }


    public function createTicket($orderId)
    {
        $orderItems = OrderItems::find()->where(['order_id' => $orderId])->all();

        foreach($orderItems as $item){
            $tour = Tours::find()->select(['name','user_id'])->where(['id' => $item->tour_id])->one();
            $company = User::find()->select(['name_company'])->where(['id' => $tour->user_id])->one();
            $model = new Tickets();
            $model->tour_name = $tour->name;
            $model->company_name = $company->name_company;
            $model->certificate = $orderId.$item->tour_id.$this->randd();
            $model->order_num = $orderId;
            $model->tour_id = $item->tour_id;
            $model->price = $item->sum;
            $model->qty = $item->qty;
            $model->save();
        }
    }

    protected function randd(){
        $this->randomInt = NULL;
        for($i = 0; $i < 5; $i++){
            $this->randomInt .= rand(1,9);
        }
        return $this->randomInt;
    }
}