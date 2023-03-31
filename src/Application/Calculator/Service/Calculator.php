<?php

declare(strict_types=1);

namespace CostCalculationModule\Application\Calculator\Service;

use CostCalculationModule\Application\Calculator\Api\CalculatorInterface;
use CostCalculationModule\Infrastructure\Delivery\Api\DeliveryServiceInterface;
use CostCalculationModule\Infrastructure\Order\Api\OrderInterface;
use CostCalculationModule\Infrastructure\Order\Service\Order;
use CostCalculationModule\Infrastructure\Request\Api\RequestInterface;

class Calculator implements CalculatorInterface
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

    public function calculateForAllDeliveryServices(RequestInterface $request): Output
    {
        $result = new Output();
        foreach ($this->deliveryServices as $deliveryService) {
            $result->addOrder(
                $this->getDeliveryServiceData($request, $deliveryService),
                $deliveryService
            );
        }

        return $result;
    }

    public function calculateForDeliveryService(
        RequestInterface         $request,
        DeliveryServiceInterface $deliveryService
    ): Output
    {
        $result = new Output();
        $result->addOrder(
            $this->getDeliveryServiceData($request, $deliveryService),
            $deliveryService
        );

        return $result;
    }

    private function getDeliveryServiceData(
        RequestInterface         $request,
        DeliveryServiceInterface $deliveryService
    ): OrderInterface
    {
        $providerData = $deliveryService->execute($request);
        $converter = $deliveryService->getConverter();

        return $converter->convert($providerData, new Order());
    }
}
