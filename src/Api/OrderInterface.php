<?php

declare(strict_types=1);

namespace CostCalculationModule\Api;

interface OrderInterface
{
    public function setPrice(float $price): void;

    public function getPrice(): ?float;

    public function setDate(string $date): void;

    public function getDate(): ?string;

    public function setError(string $error): void;

    public function getError(): ?string;
}
