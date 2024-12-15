<?php

namespace common\searchModels;

use common\models\ClientLoan;
use common\models\LoanProduct;
use yii\data\ActiveDataProvider;

class ClientLoanSearch extends ClientLoan
{
    public function rules(): array
    {
        return [
            [['client_id'], 'integer'],
        ];
    }

    public function search($params)
    {
        $query = ClientLoan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load(['ClientLoanSearch' => $params]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'client_id' => $this->client_id,
        ]);

        return $dataProvider;
    }
}
