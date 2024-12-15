<?php

namespace common\loanCheckers;

use common\models\ClientInterface;
use common\models\LoanInterface;

abstract class AbstractLoanChecker implements LoanCheckerInterface
{
    protected ?LoanCheckerInterface $nextCheck = null;

    public function setNext(LoanCheckerInterface $nextCheck): LoanCheckerInterface
    {
        $this->nextCheck = $nextCheck;
        return $nextCheck;
    }

    public function check(ClientInterface $client, LoanInterface $loan): LoanInterface
    {
        return $this->nextCheck?->check($client, $loan) ?? $loan;
    }
}