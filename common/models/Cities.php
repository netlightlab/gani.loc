<?php

namespace common\models;

use Yii;
use common\models\Countries;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property int $country_parent
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['country_parent'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Город',
            'country_parent' => 'Страна',
        ];
    }


    public function getCountriesList(){
        $countries = Countries::find()->asArray()->all();
        $result = [];
        foreach($countries as $country){
            $result[$country['id']] = $country['name'];
        }
        return $result;
    }
	
	public function getCountriesName($id){
		$country = Countries::find()->where(['id' => $id])->one();
		return $country->name;
	}
}
