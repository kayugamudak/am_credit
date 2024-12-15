<?php

namespace common\searchModels;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Client;

class ClientSearch extends Client
{
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['first_name', 'last_name', 'ssn', 'state_code', 'city', 'email', 'income'], 'safe'],
            [['age'], 'number'],
        ];
    }

    public function search($params)
    {
        $query = Client::find();

        // Create a data provider and attach the query to it
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // If validation fails, return the data provider without applying any filters
            return $dataProvider;
        }

        // Apply filters based on the search input
        $query->andFilterWhere([
            'id' => $this->id,
            'age' => $this->age,
            'income' => $this->income,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'ssn', $this->ssn])
            ->andFilterWhere(['like', 'state_code', $this->state_code])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
