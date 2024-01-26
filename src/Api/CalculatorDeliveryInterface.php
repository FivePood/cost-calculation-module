<?php

declare(strict_types=1);

namespace CostCalculationModule\Api;

use CostCalculationModule\Service\Output;

interface CalculatorDeliveryInterface
{
    public function setDeliveryServices(array $deliveryServices = []): void;

    public function addDeliveryService(DeliveryServiceInterface $deliveryService): bool;

    public function removeDeliveryService(DeliveryServiceInterface $deliveryService): bool;

    public function calculateForAllDeliveryServices(ShippingInterface $shipping): Output;

    public function calculateForDeliveryService(ShippingInterface $shipping, DeliveryServiceInterface $deliveryService): Output;
}
