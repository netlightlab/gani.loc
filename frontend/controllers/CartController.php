<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.03.2018
 * Time: 12:15
 */

namespace frontend\controllers;


use yii\db\Exception;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;
use frontend\models\Tours;
use yii\helpers\ArrayHelper;
use common\models\Orders;
use common\models\OrderItems;
use frontend\models\SignupForm;
use frontend\models\LoginForm;
use common\models\PG_Signature;
use common\models\User;
use yii\web\Response;
use common\models\Tickets;

class CartController extends Controller
{
    public $orders = array();
    protected $tours = array();

    public function beforeAction($action)
    {
        if($action->id == 'pay-result'){
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex(){

        $orders = Yii::$app->session->get('tour_id');

        //print_r($_SESSION);

        $model = new Orders();

        if($orders)
            $cartTours = $this->getCartTours($orders);

        return $this->render('index', [
            //'orders' => $orders ? $orders : $orders = array('id' => 0, 'text' => 'empty')
            'model' => $model,
            'orders' => $this->tours ? $this->tours : $this->tours = 'text'
        ]);
    }

    public function actionAdd(){
        $this->orders = Yii::$app->session->get('tour_id');

        ArrayHelper::setValue($this->orders, Yii::$app->request->post('tour_id'),(int)              Yii::$app->request->post('tour_id'));


        Yii::$app->session['tour_id'] = $this->orders;

        return true;
    }

    protected function getCartTours(array $tours)
    {
        foreach ($tours as $tour) {
            $this->tours[] = Tours::find()->where(['id' => $tour])->one();
        }

        return $this->tours;
    }

    public function actionRemoveFromCart(){
        $id = (int)Yii::$app->request->post('id');
        if(!is_int($id)){
            return false;
        }

        unset($_SESSION['tour_id'][$id]);

        return true;
    }




    public function actionCheckout(){
        $model = new Orders();
        $data = Yii::$app->request->post();
        $userId = Yii::$app->user->id;

        if(Yii::$app->user->isGuest){
            $this->redirect(['/cart/auth']);
            Yii::$app->session->setFlash('success', 'Необходимо зарегистрироваться или войти');
            return false;
        }

        if(is_array($data['Orders'])){
            if($model->load($data) && $model->validate()){
                $model->user_id = $userId;
                $model->sum = $data['Orders']['total'];
                if($model->save(false)){
                    if($this->saveOrderItems($model->id, $data['Orders']) && $this->payOrder($model->id, $data)){
                        unset($_SESSION['tour_id']);
                        //$this->redirect(['/cart/index']);
                        //Yii::$app->session->setFlash('success', 'Готово');
                    }
                }
            }
        }

        return true;
    }

    protected function saveOrderItems($orderId, $items){
        unset($items['total']);
        foreach($items as $item){
            if($item['qty'] != 0){
                $mod = new OrderItems();
                $mod->order_id = $orderId;
                $mod->sum = (int)$item['sum'];
                $mod->tour_id = (int)$item['tour_id'];
                $mod->qty = (int)$item['qty'];
                $mod->save();
            }
        }

        return true;
    }

    public function actionAuth(){
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/cart/index');
        } else {
            return $this->render('auth', [
                'model' => $model
            ]);
        }
    }


    private $merchant_id = '10751';
    private $merchant_secret_key = 'pexabiqoqepujiqy';
    private $test_pay = true;
    public function payOrder($orderId,$orderData){
        $arrReq = array();
        //print_r($orderData);
        $userPhone = User::find()->where(['id' => Yii::$app->user->id])->select('phone')->one();
        $arrReq['pg_merchant_id'] = $this->merchant_id;// Идентификатор магазина
        $arrReq['pg_order_id'] = $orderId;        // Идентификатор заказа в системе магазина
        $arrReq['pg_amount'] = intval($orderData['Orders']['total']);        // Сумма заказа
        $arrReq['pg_lifetime'] = 3600 * 24;    // Время жизни счёта (в секундах)
        $arrReq['pg_description'] = 'Заказ №' . $orderId; // Описание заказа (показывается в Платёжной системе)
        $arrReq['pg_user_phone'] = $userPhone->phone ? $userPhone->phone : '';
        $arrReq['pg_currency'] = 'KZT';
        if ($this->test_pay) {
//                $arrReq['pg_payment_system'] = 'TEST';
            $arrReq['pg_testing_mode'] = 1;
//                $arrReq['pg_payment_system'] = 'TESTCARD';
        } else {
//                $arrReq['pg_payment_system'] = 'EPAYKZT';
        }

        //$arrReq['pg_success_url'] =Url::to(['api/pay-ok'],true);
        $arrReq['pg_success_url'] =Url::to(['cart/pay-ok'],true);
        $arrReq['pg_success_url_method'] = 'AUTOPOST';
        //$arrReq['pg_check_url'] = Url::to(['api/pay-check'],true);
        $arrReq['pg_check_url'] = Url::to(['cart/pay-check'],true);
        //$arrReq['pg_result_url'] = Url::to(['api/pay-result'],true);
        $arrReq['pg_result_url'] = Url::to(['cart/pay-result'],true);
        $arrReq['pg_request_method'] = 'POST';
        /* Параметры безопасности сообщения. Необходима генерация pg_salt и подписи сообщения. */
        $arrReq['pg_salt'] = rand(21, 43433);
        $arrReq['pg_sig'] = PG_Signature::make('payment.php', $arrReq, $this->merchant_secret_key);
        $query = http_build_query($arrReq);
        return $this->redirect('https://www.paybox.kz/payment.php?'.$query);
        //print_r(http_build_query($arrReq));
    }


    public function actionPayCheck()
    {
        \Yii::$app->response->format = Response::FORMAT_XML;
        $arrParams = $_POST;
        $order_id = $arrParams['pg_order_id'];
        if (PG_Signature::check($arrParams['pg_sig'], $this->action->id, $arrParams, $this->merchant_secret_key)) {
            $result = [];
            $result['pg_salt'] = $arrParams['pg_salt'];
            if ($order = Orders::find()->andWhere(['id' => $order_id, 'paid' => 0])->one()) {
                $result['pg_status'] = 'ok';
                $result['pg_description'] = '';
            } else {
                $result['pg_status'] = 'error';
                $result['pg_description'] = 'Заказ не найден или уже оплачен!';
            }
            $result['pg_sig'] = PG_Signature::make($this->action->id, $result, $this->merchant_secret_key);
            return $result;
        } else {
            throw new BadRequestHttpException();
        }
    }
    public function actionPayOk()
    {
        $arrParams = $_GET;
        $order_id = $arrParams['pg_order_id'];
        if (PG_Signature::check($arrParams['pg_sig'], $this->action->id, $arrParams, $this->merchant_secret_key)) {
//            Orders::updateAll(['paid' => 1], ['id' => $order_id, 'paid' => 0]);
            return $this->redirect(['cart/index']);
        } else {
            throw new BadRequestHttpException();
        }
    }
    public function actionGetTest(){
        return $this->redirect(['cart/index']);
    }
    public function actionPayResult()
    {
//        $tickets = new Tickets();
//        $tickets->createTicket(61);
        \Yii::$app->response->format = Response::FORMAT_XML;
        $arrParams = $_POST;
        $order_id = $arrParams['pg_order_id'];
        if (PG_Signature::check($arrParams['pg_sig'], $this->action->id, $arrParams, $this->merchant_secret_key))      {
            if ($arrParams['pg_result'] == 1) {
                Orders::updateAll(['paid' => 1], ['id' => $order_id, 'paid' => 0]);
                $tickets = new Tickets();
                $tickets->createTicket($order_id);
                $result = [
                    'pg_salt'=>$arrParams['pg_salt'],
                    'pg_status'=>'ok',
                    'pg_description'=> "Оплата принята",
                ];
            } else {
                $result = [
                    'pg_salt'=>$arrParams['pg_salt'],
                    'pg_status'=>'error',
                    'pg_description'=> 'Оплата принята',
                    'pg_error_description'=> 'Платёж не прошёл',
                ];
            }
            $result['pg_sig'] = PG_Signature::make($this->action->id, $result, $this->merchant_secret_key);
            return $result;
        } else {
             new BadRequestHttpException();
        }
    }

}