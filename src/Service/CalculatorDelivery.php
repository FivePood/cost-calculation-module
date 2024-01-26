<?php

declare(strict_types=1);

namespace CostCalculationModule\Service;

use CostCalculationModule\Api\CalculatorDeliveryInterface;
use CostCalculationModule\Api\DeliveryServiceInterface;
use CostCalculationModule\Api\OrderInterface;
use CostCalculationModule\Api\ShippingInterface;

class CalculatorDelivery implements CalculatorDeliveryInterface
{
    /**
     * @var DeliveryServiceInterface[]
     */
    protected array $deliveryServices = [];

    /**
     * @param DeliveryServiceInterface[] $deliveryServices
     */
    public function __construct(array $deliveryServices = [])
    {
        $this->setDeliveryServices($deliveryServices);
    }

    /**
     * @param DeliveryServiceInterface[] $deliveryServices
     */
    public function setDeliveryServices(array $deliveryServices = []): void
    {
        $this->deliveryServices = [];
        foreach ($deliveryServices as $deliveryService) {
            $this->addDeliveryService($deliveryService);
        }
    }

    public function addDeliveryService(DeliveryServiceInterface $deliveryService): bool
    {
        if (!isset($this->deliveryServices[get_class($deliveryService)])) {
            $this->deliveryServices[get_class($deliveryService)] = $deliveryService;
            return true;
        }

        return false;
    }

    public function removeDeliveryService(DeliveryServiceInterface $deliveryService): bool
    {
        if (isset($this->deliveryServices[get_class($deliveryService)])) {
            unset($this->deliveryServices[get_class($deliveryService)]);
            return true;
        }

        return false;
    }

    public function calculateForAllDeliveryServices(ShippingInterface $shipping): Output
    {
        $result = new Output();
        foreach ($this->deliveryServices as $deliveryService) {
            $result->addOrder(
                $this->getDeliveryServiceData($shipping, $deliveryService),
                $deliveryService
            );
        }

        return $result;
    }

    public function calculateForDeliveryService(ShippingInterface $shipping, DeliveryServiceInterface $deliveryService): Output
    {
        $result = new Output();
        $result->addOrder(
            $this->getDeliveryServiceData($shipping, $deliveryService),
            $deliveryService
        );

        return $result;
    }

    private function getDeliveryServiceData(ShippingInterface $shipping, DeliveryServiceInterface $deliveryService): OrderInterface
    {
        $providerData = $deliveryService->execute($shipping);
        $converter = $deliveryService->getConverter();

        return $converter->convert($providerData, $deliveryService, new Order());
    }
}
