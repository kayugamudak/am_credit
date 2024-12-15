<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;


class ClientLoan extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'client_loan';
    }

    public function rules(): array
    {
        return [
            [['client_id', 'loan_product_id'], 'integer'],
            [['name', 'loan_term_days', 'percentage_rate', 'amount', 'client_id', 'loan_product_id', 'client_id'], 'required'],
            [['name'], 'string', 'max' => 1024],
            ['loan_term_days', 'number', 'integerOnly' => true, 'min' => 1, 'max' => 18263], // max 50 years
            ['percentage_rate', 'number', 'min' => 0], //max depends on law
            ['amount', 'number', 'min' => 1],
            ['approved', 'boolean'],
            ['loan_product_id', 'exist', 'targetClass' => LoanProduct::class, 'targetAttribute' => 'id', 'message' => 'The selected loan product does not exist.'],
            ['client_id', 'exist', 'targetClass' => Client::class, 'targetAttribute' => 'id', 'message' => 'The selected client does not exist.'],
        ];
    }

}
