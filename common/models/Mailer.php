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


class Mailer extends Model
{
    public $toEmail = 'igor@netlight.kz';
    public $subject = 'Вопрос с сайта eltourism';
    public $body;

    public function rules()
    {
        return [
            [['', 'body'], 'required'],
            ['fromEmail', 'email'],
            ['toEmail', 'email']
        ];
    }

    public function sendEmail()
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($this->toEmail)
                ->setFrom([$this->fromEmail => $this->fromName])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}