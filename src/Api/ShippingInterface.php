<?php

declare(strict_types=1);

namespace CostCalculationModule\Api;

interface ShippingInterface
{
    public function getSourceKladr(): string;

    public function getTargetKladr(): string;

    public function getWeight(): float;
}
