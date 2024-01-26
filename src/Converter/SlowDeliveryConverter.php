<?php

declare(strict_types=1);

namespace CostCalculationModule\Converter;

use CostCalculationModule\Api\DeliveryServiceInterface;
use CostCalculationModule\Api\OrderInterface;
use Exception;
use RuntimeException;

class SlowDeliveryConverter extends AbstractConverter
{
    /**
     * @throws Exception
     */
    public function convert(mixed $data, DeliveryServiceInterface $deliveryService, OrderInterface $order): OrderInterface
    {
        try {
            $coefficient = $data['coefficient'] ?: 1;
            $order->setPrice($coefficient * $deliveryService->settings['slow']['price']);
            $order->setDate($data['date']);
            $order->setError($data['error']);
        } catch (Exception $e) {
            throw new RuntimeException("Runtime error. {$e->getMessage()}");
        }

        return $order;
    }
}
