<?php

namespace common\LoanCheckers;

use common\models\LoanInterface;
use common\models\ClientInterface;

interface LoanCheckerInterface
{
    public function setNext(LoanCheckerInterface $nextCheck): LoanCheckerInterface;

    public function check(ClientInterface $client, LoanInterface $loan): LoanInterface;
}