<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Request\Api;

interface RequestInterface
{
    public function getSourceKladr(): string;

    public function getTargetKladr(): string;

    public function getWeight(): float;
}
