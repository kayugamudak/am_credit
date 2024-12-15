<?php

namespace common\loanCheckers;

use common\models\ClientInterface;
use common\models\LoanInterface;

class IncomeChecker extends AbstractLoanChecker
{
    public function check(ClientInterface $client, LoanInterface $loan): LoanInterface
    {
        if ($client->getIncome() < $loan->getMinIncome()) {
            $loan->deny();
        }
        return parent::check($client, $loan);

    }
}