<?php

namespace common\services;

use common\models\ClientInterface;
use common\models\LoanProductInterface;
use common\models\LoanInterface;
use common\loanCheckers\AgeChecker;
use common\loanCheckers\CreditScoreChecker;
use common\loanCheckers\IncomeChecker;
use common\loanCheckers\StateChecker;
use common\models\Loan;

class LoanService {

    private int $minFicoCreditScore;
    private int $minIncome;
    private int $minAge;
    private int $maxAge;
    private array $allowedStates;

    public function __construct(
        int $minFicoCreditScore,
        int $minIncome,
        int $minAge,
        int $maxAge,
        array $allowedStates
    ) {
        $this->minFicoCreditScore = $minFicoCreditScore;
        $this->minIncome = $minIncome;
        $this->minAge = $minAge;
        $this->maxAge = $maxAge;
        $this->allowedStates = $allowedStates;
    }


    public function getLoan(ClientInterface $client, LoanProductInterface $loanProduct): ?LoanInterface {

        $loan = new Loan(
            $loanProduct,
            $this->minFicoCreditScore,
            $this->minIncome,
            $this->minAge,
            $this->maxAge,
            $this->allowedStates,
        );

        $loanChecker = new AgeChecker();
        $loanChecker
            ->setNext(new CreditScoreChecker())
            ->setNext(new IncomeChecker())
            ->setNext(new StateChecker());

        return $loanChecker->check($client, $loan);
    }

}
