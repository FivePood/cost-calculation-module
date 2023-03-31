<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Request\Service;

use CostCalculationModule\Infrastructure\Request\Api\RequestInterface;

class Request implements RequestInterface
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
