<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Converter\Service;

use CostCalculationModule\Infrastructure\Converter\Api\ConverterInterface;
use CostCalculationModule\Infrastructure\Order\Api\OrderInterface;

abstract class AbstractConverter implements ConverterInterface
{
    abstract public function convert(mixed $data, OrderInterface $order): OrderInterface;
}
