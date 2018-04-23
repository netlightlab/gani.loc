<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tours;

/**
 * Search represents the model behind the search form of `\frontend\models\Tours`.
 */
class Search extends Tours
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'country_id', 'place_id', 'price_child', 'category_id', 'price_child_free', 'status', 'rating', 'price', 'city_id'], 'integer'],
            [['name', 'official_name', 'description', 'mini_description', 'dot_place', 'tour_language', 'conditions', 'return_cond', 'back_image', 'mini_image', 'gallery', 'dot_place_addr', 'w_included'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Tours::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

//        $params['Search']['price_from'] ? $this->price_from = $params['Search']['price_from'] : NULL;
//        $params['Search']['price_to'] ? $this->price_to = $params['Search']['price_to'] : NULL;
//        $a = explode(',', $params['Search']['price_from']);

//        $this->price_from = $a[0];
//        $this->price_to = $a[1];

//        print_r($params);

        $this->price_from = $params['Search']['price_from'] ? (int)$params['Search']['price_from'] : NULL ;
        $this->price_to = $params['Search']['price_to'] ? (int)$params['Search']['price_to'] : NULL;
//        $this->filter_categories = $params['Search']['filter_categories'] ? explode(',', $params['Search']['filter_categories']) : NULL;
        $this->filter_categories = $params['Search']['filter_categories'];

//        print_r($this->id);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
//             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'country_id' => $this->country_id,
            'place_id' => $this->place_id,
            'category_id' => $this->category_id,
            'price_child' => $this->price_child,
            'price_child_free' => $this->price_child_free,
            'status' => $this->status,
            'rating' => $this->rating,
            'price' => $this->price,
            'city_id' => $this->city_id,
        ]);

//        print_r($this->filter_categories);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'official_name', $this->official_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'mini_description', $this->mini_description])
            ->andFilterWhere(['like', 'dot_place', $this->dot_place])
            ->andFilterWhere(['like', 'tour_language', $this->tour_language])
            ->andFilterWhere(['like', 'conditions', $this->conditions])
            ->andFilterWhere(['like', 'return_cond', $this->return_cond])
            ->andFilterWhere(['like', 'back_image', $this->back_image])
            ->andFilterWhere(['like', 'mini_image', $this->mini_image])
            ->andFilterWhere(['like', 'gallery', $this->gallery])
            ->andFilterWhere(['like', 'dot_place_addr', $this->dot_place_addr])
            ->andFilterWhere(['like', 'w_included', $this->w_included])
            ->andFilterWhere(['in', 'category_id', $this->filter_categories])
            ->andFilterWhere(['>=', 'price', $this->price_from])
            ->andFilterWhere(['<=', 'price', $this->price_to]);

        return $dataProvider;
    }
}
