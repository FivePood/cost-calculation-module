<?php

declare(strict_types=1);

namespace CostCalculationModule\Api;

interface ConverterInterface
{
    public function convert(mixed $data, DeliveryServiceInterface $deliveryService, OrderInterface $order): OrderInterface;
}
