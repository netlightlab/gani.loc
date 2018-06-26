<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.06.2018
 * Time: 10:59
 */

namespace frontend\widgets\GSettings;

use yii\base\Widget;
use common\models\Settings;
use yii\helpers\ArrayHelper;

class GSettings extends Widget
{
    public $param;
    public $value;

    public function init(){
        parent::init();
        $data = Settings::find()->asArray()->all();
        $settings = ArrayHelper::map($data, 'param', 'value');
        if($this->param){
            $this->value = $settings[$this->param];
        }
    }

    public function run(){
        return $this->value;
    }
}