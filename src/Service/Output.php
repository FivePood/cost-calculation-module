<?php

declare(strict_types=1);

namespace CostCalculationModule\Service;

use CostCalculationModule\Api\DeliveryServiceInterface;
use CostCalculationModule\Api\OrderInterface;

class Output
{
    /**
     * @var OrderInterface[]
     */
    protected array $orders = [];

    public function addOrder(OrderInterface $output, DeliveryServiceInterface $deliveryService): void
    {
        $nameList = explode('\\', get_class($deliveryService));
        $serviceName = end($nameList);
        $this->orders[$serviceName] = [
            'price' => $output->getPrice(),
            'date' => $output->getDate(),
            'error' => $output->getError()
        ];
    }

    public function getOrders(): array
    {
        return $this->orders;
    }
}
