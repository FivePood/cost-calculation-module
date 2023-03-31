<?php

declare(strict_types=1);

namespace CostCalculationModule\Application\Calculator\Service;

use CostCalculationModule\Infrastructure\Delivery\Api\DeliveryServiceInterface;
use CostCalculationModule\Infrastructure\Order\Api\OrderInterface;

class Output
{
    /**
     * @var OrderInterface[]
     */
    protected array $orders = [];

    public function addOrder(OrderInterface $output, DeliveryServiceInterface $deliveryService): void
    {
        $this->orders[get_class($deliveryService)] = $output;
    }
}
