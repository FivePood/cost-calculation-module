<?php

declare(strict_types=1);

namespace CostCalculationModule\Service;

use CostCalculationModule\Api\OrderInterface;

class Order implements OrderInterface
{
    private float $price;
    private string $date;
    private string $error;

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setError(string $error): void
    {
        $this->error = $error;
    }

    public function getError(): ?string
    {
        return $this->error;
    }
}
