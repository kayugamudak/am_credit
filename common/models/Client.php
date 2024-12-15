<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\USStatesDictionary;

class Client extends ActiveRecord implements ClientInterface
{

    public static function tableName(): string
    {
        return 'client';
    }

    public function rules(): array
    {
        return [
            [['first_name', 'last_name', 'age', 'ssn', 'state_code', 'city', 'zip', 'fico_credit_score', 'email', 'phone', 'income', 'address'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            ['age', 'number', 'integerOnly' => true, 'min' => 1, 'max' => 150],
            ['income', 'number', 'min' => 0],
            ['ssn', 'match', 'pattern' => '/^\d{9}$/', 'message' => 'SSN must be 9 digits'],
            ['fico_credit_score', 'number', 'integerOnly' => true, 'min' => 300, 'max' => 850],
            ['city', 'string', 'max' => 255],
            ['address', 'string', 'max' => 255],
            ['state_code', 'string', 'length' => 2],
            [
                'state_code',
                function ($attribute) {
                    if (!USStatesDictionary::isValidCode($this->$attribute)) {
                        $this->addError($attribute, 'Invalid state code');
                    }
                }
            ],
            ['zip', 'match', 'pattern' => '/^\d{5}(?:[-\s]\d{4})?$/', 'message' => 'ZIP must be XXXXX or XXXXX-XXXX'],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '/^\+?\d{1,4}?[ -]?\(?\d{1,4}?\)?[ -]?\d{1,4}[ -]?\d{1,4}$/', 'message' => 'Invalid phone number format'],
        ];
    }

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }

    public function getAge(): int {
        return $this->age;
    }

    public function getFicoCreditScore(): int {
        return $this->fico_credit_score;
    }

    public function getIncome(): float {
        return $this->income;
    }

    public function getStateCode(): string {
        return $this->state_code;
    }

}
