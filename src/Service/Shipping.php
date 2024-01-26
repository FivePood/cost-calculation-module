<?php

declare(strict_types=1);

namespace CostCalculationModule\Service;

use CostCalculationModule\Api\ShippingInterface;

class Shipping implements ShippingInterface
{
    protected string $sourceKladr;
    protected string $targetKladr;
    protected float $weight;

    public function __construct(string $sourceKladr, string $targetKladr, float $weight)
    {
        $this->sourceKladr = $sourceKladr;
        $this->targetKladr = $targetKladr;
        $this->weight = $weight;
    }

    public function getSourceKladr(): string
    {
        return $this->sourceKladr;
    }

    public function getTargetKladr(): string
    {
        return $this->targetKladr;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }
}
