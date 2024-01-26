<?php

declare(strict_types=1);

namespace CostCalculationModule\Api;

interface DeliveryServiceInterface
{
    public function execute(ShippingInterface $shipping): mixed;

    public function getConverter(): ConverterInterface;
}
