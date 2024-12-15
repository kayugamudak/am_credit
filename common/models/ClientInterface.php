<?php

namespace common\models;

interface ClientInterface
{
    public function getFirstName(): string;

    public function getLastName(): string;

    public function getFicoCreditScore(): int;

    public function getIncome(): float;

    public function getAge(): int;

    public function getStateCode(): string;
}
