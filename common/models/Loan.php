<?php

namespace common\models;

use common\models\LoanProductInterface;
use yii\base\Model;

class Loan extends Model implements LoanInterface {

    private LoanProductInterface $loanProduct;

    private float $percentageRate;
    private int $minFicoCreditScore;
    private float $minIncome;
    private int $minAge;
    private int $maxAge;
    private array $allowedStates;
    private bool $preApproved = true;

    public function __construct(
        LoanProductInterface $loanProduct,
        int $minFicoCreditScore,
        float $minIncome,
        int $minAge,
        int $maxAge,
        array $allowedStates = [],
    ) {
        $this->loanProduct = $loanProduct;
        $this->percentageRate = $loanProduct->getPercentageRate();
        $this->minFicoCreditScore = $minFicoCreditScore;
        $this->minIncome = $minIncome;
        $this->minAge = $minAge;
        $this->maxAge = $maxAge;
        $this->allowedStates = $allowedStates;
    }

    public function getPercentageRate(): float {
        return $this->percentageRate;
    }

    public function getMinFicoCreditScore(): int {
        return $this->minFicoCreditScore;
    }

    public function getMinIncome(): float {
        return $this->minIncome;
    }

    public function getMinAge(): int {
        return $this->minAge;
    }

    public function getMaxAge(): int {
        return $this->maxAge;
    }

    public function getAllowedStates(): array {
        return $this->allowedStates;
    }


    public function setPercentageRate(float $percentageRate): void {
        $this->percentageRate = $percentageRate;
    }

    public function deny(): void {
        $this->preApproved = false;
    }

    public function isPreApproved(): bool {
        return $this->preApproved;
    }


    public function fields(): array {
        return [
            'name' => function () {
                return $this->loanProduct->getName();
            },
            'amount' => function () {
                return $this->loanProduct->getAmount();
            },
            'loan_term_days' => function () {
                return $this->loanProduct->getLoanTermDays();
            },
            'percentage_rate' => function () {
                return $this->getPercentageRate();
            },
            'pre_approved' => function () {
                return $this->isPreApproved();
            },
            'loan_product_id' => function () {
                return $this->loanProduct->getId();
            },
        ];
    }

}