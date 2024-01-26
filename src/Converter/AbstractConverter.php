<?php

declare(strict_types=1);

namespace CostCalculationModule\Converter;

use CostCalculationModule\Api\ConverterInterface;
use CostCalculationModule\Api\DeliveryServiceInterface;
use CostCalculationModule\Api\OrderInterface;

abstract class AbstractConverter implements ConverterInterface
{
    abstract public function convert(mixed $data, DeliveryServiceInterface $deliveryService, OrderInterface $order): OrderInterface;
}
