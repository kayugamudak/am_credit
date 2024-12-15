<?php

namespace common\models;

interface LoanProductInterface {

    public function getName(): string;

    public function getPercentageRate(): float;

    public function getLoanTermDays(): int;

    public function getAmount(): float;

    public function getId(): int;
}