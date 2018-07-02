<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.06.2018
 * Time: 11:40
 */

namespace frontend\widgets\MultiLang;

use yii\helpers\Html;
use yii\bootstrap\Widget;

class MultiLang extends Widget
{
    public $cssClass;
    public function init(){}

    public function run() {

        return $this->render('view', [
            'cssClass' => $this->cssClass,
        ]);

    }
}