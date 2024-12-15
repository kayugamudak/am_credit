<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\db\Expression;


class LoanProduct extends ActiveRecord implements LoanProductInterface
{


    public static function tableName(): string
    {
        return 'loan_product';
    }

    public function rules(): array
    {
        return [
            [['name', 'loan_term_days', 'percentage_rate', 'amount'], 'required'],
            [['name'], 'string', 'max' => 1024],
            ['loan_term_days', 'number', 'integerOnly' => true, 'min' => 1, 'max' => 18263], // max 50 years
            ['percentage_rate', 'number', 'min' => 0], //max depends on law
            ['amount', 'number', 'min' => 1],
        ];
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPercentageRate(): float {
        return $this->percentage_rate;
    }

    public function getLoanTermDays(): int {
        return $this->loan_term_days;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function getId(): int {
        return $this->id;
    }
}
