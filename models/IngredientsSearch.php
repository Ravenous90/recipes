<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ingredients;

/**
 * IngredientsSearch represents the model behind the search form of `app\models\Ingredients`.
 */
class IngredientsSearch extends Ingredients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'amount'], 'integer'],
            [['title'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Ingredients::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'title' => $this->title,
            'amount' => $this->amount,
            'measure_id' => $this->measure_id,
        ]);

        return $dataProvider;
    }

    public function searchOwnIngs($params)
    {
        $query = Ingredients::find()
            ->select('*')
            ->leftJoin('recipes_to_ingredients', '`recipes_to_ingredients`.`ingredient_id` = `ingredients`.`id`')
            ->where(['`recipes_to_ingredients`.`recipe_id`' => $params['id']])
            ->with('recipes_to_ingredients');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) return $dataProvider;

        $query->andFilterWhere([
            'id' => $this->id,
            'title' => $this->title,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
