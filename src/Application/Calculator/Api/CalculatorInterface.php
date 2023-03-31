<?php

declare(strict_types=1);

namespace CostCalculationModule\Application\Calculator\Api;

use CostCalculationModule\Application\Calculator\Service\Output;
use CostCalculationModule\Infrastructure\Delivery\Api\DeliveryServiceInterface;
use CostCalculationModule\Infrastructure\Request\Api\RequestInterface;

interface CalculatorInterface
{
    public function setDeliveryServices(array $deliveryServices = []): void;

    public function addDeliveryService(DeliveryServiceInterface $deliveryService): bool;

    public function removeDeliveryService(DeliveryServiceInterface $deliveryService): bool;

    public function calculateForAllDeliveryServices(RequestInterface $request): Output;

    public function calculateForDeliveryService(RequestInterface $request, DeliveryServiceInterface $deliveryService): Output;
}
