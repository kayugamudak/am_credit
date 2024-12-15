<?php

namespace common\loanCheckers;

use common\models\ClientInterface;
use common\models\LoanInterface;

class StateChecker extends AbstractLoanChecker
{
    public function check(ClientInterface $client, LoanInterface $loan): LoanInterface
    {

        $state = $client->getStateCode();

        if (!in_array($state, $loan->getAllowedStates())) {
            $loan->deny();
        }

        if ($state === 'NY' && random_int(0, 1) === 0) { //TODO move to db and DI
            $loan->deny();
        }

        if ($state === 'CA') {
            $loan->setPercentageRate($loan->getPercentageRate() + 11.49); //TODO move to db and DI
        }

        return parent::check($client, $loan);

    }
}