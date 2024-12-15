<?php

namespace common\models;

interface LoanInterface {
    public function getPercentageRate(): float;
    public function getMinFicoCreditScore(): int;
    public function getMinIncome(): float;
    public function getMinAge(): int;
    public function getMaxAge(): int;
    public function getAllowedStates(): array;
    public function setPercentageRate(float $percentageRate): void;
    public function deny(): void;
    public function isPreApproved(): bool;
}