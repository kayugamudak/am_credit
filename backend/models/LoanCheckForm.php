<?php

namespace backend\models;

use common\models\Client;
use yii\base\Model;
use common\models\LoanProduct;

class LoanCheckForm extends Model
{
    public int $clientId;
    public ?int $loanProductId = null;

    public function rules()
    {
        return [
            [['clientId', 'loanProductId'], 'required'],
            [['clientId', 'loanProductId'], 'integer'],
            ['loanProductId', 'exist', 'targetClass' => LoanProduct::class, 'targetAttribute' => 'id', 'message' => 'The selected loan product does not exist.'],
            ['clientId', 'exist', 'targetClass' => Client::class, 'targetAttribute' => 'id', 'message' => 'The selected client does not exist.'],
        ];
    }}