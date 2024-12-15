<?php

namespace common\loanCheckers;

use common\models\ClientInterface;
use common\models\LoanInterface;

class CreditScoreChecker extends AbstractLoanChecker
{
    public function check(ClientInterface $client, LoanInterface $loan): LoanInterface
    {
        if ($client->getFicoCreditScore() < $loan->getMinFicoCreditScore()) {
            $loan->deny();
        }
        return parent::check($client, $loan);
    }
}