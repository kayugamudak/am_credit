<?php

namespace common\loanCheckers;

use common\models\ClientInterface;
use common\models\LoanInterface;

class AgeChecker extends AbstractLoanChecker
{
    public function check(ClientInterface $client, LoanInterface $loan): LoanInterface
    {
        $age = $client->getAge();
        if ($age < $loan->getMinAge() || $age > $loan->getMaxAge()) {
            $loan->deny();
        }
        return parent::check($client, $loan);
    }
}