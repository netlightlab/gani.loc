<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.04.2018
 * Time: 18:46
 */

namespace common\models;

use Yii;
use yii\base\Model;


class Mainform extends Model
{
    public $toEmail = 'igor@netlight.kz';
    public $subject = 'Вопрос с сайта eltourism';
    public $name;
    public $mail;
    public $message;

    public function rules()
    {
        return [
            [['name','mail','message'], 'required'],
            [['name','mail','message'], 'trim'],
            [['mail', 'toEmail'], 'email'],
        ];
    }

    public function sendEmail()
    {
        if ($this->validate()) {
            $body = $this->name . $this->mail . $this->message;
            return Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['supportEmail'])
                ->setTo($this->toEmail)
                ->setSubject($this->subject)
                ->setTextBody($body)
                ->send();
        }
        return false;
    }
}