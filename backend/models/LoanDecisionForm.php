<?php

namespace backend\models;

use yii\base\Model;
use common\models\LoanProduct;
use common\models\Client;

class LoanDecisionForm extends Model
{
    public ?int $loan_product_id = null;
    public ?float $percentage_rate = null;
    public ?bool $approved = null;
    public ?int $amount = null;
    public ?int $loan_term_days = null;
    public ?int $client_id = null;
    public ?bool $send_sms = null;
    public ?bool $send_email = null;
    public ?string $name = null;

    public function rules()
    {
        return [
            [['client_id', 'loan_product_id', 'name', 'loan_term_days', 'percentage_rate', 'amount', 'approved'], 'required'],
            [['name'], 'string', 'max' => 1024],
            [['client_id', 'loan_product_id'], 'number', 'integerOnly' => true],
            ['loan_term_days', 'number', 'integerOnly' => true, 'min' => 1, 'max' => 18263], // max 50 years
            ['percentage_rate', 'number', 'min' => 0], //max depends on law
            ['amount', 'number', 'min' => 1],
            ['loan_product_id', 'exist', 'targetClass' => LoanProduct::class, 'targetAttribute' => 'id', 'message' => 'The selected loan product does not exist.'],
            ['client_id', 'exist', 'targetClass' => Client::class, 'targetAttribute' => 'id', 'message' => 'The selected client does not exist.'],
            [['approved', 'send_email', 'send_sms'], 'boolean'],
        ];
    }

}