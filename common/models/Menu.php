<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.04.2018
 * Time: 16:48
 */

namespace common\models;

use frontend\models\Page;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $slink
 * @property int $sort
 */

class Menu extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 150],
            [['slink'], 'string', 'max' => 150],
            [['sort'], 'integer'],
        ];
    }

    public function getAllLinks(){
        $pages = ArrayHelper::map(Page::find()->select('id,title')->indexBy('id')->asArray()->all(), 'id', 'title');
        array_unshift($pages, '');
        return $pages;
    }
}