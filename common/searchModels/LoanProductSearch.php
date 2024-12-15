<?php

namespace common\searchModels;

use common\models\LoanProduct;
use yii\data\ActiveDataProvider;

class LoanProductSearch extends LoanProduct
{
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
            [['loan_term_days', 'percentage_rate', 'amount'], 'number'],
        ];
    }

    public function search($params)
    {
        $query = LoanProduct::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'loan_term_days' => $this->loan_term_days,
            'percentage_rate' => $this->percentage_rate,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
