<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Converter\Api;

use CostCalculationModule\Infrastructure\Order\Api\OrderInterface;

interface ConverterInterface
{
    public function convert(mixed $data, OrderInterface $order): OrderInterface;
}
