<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Converter\Service;

use CostCalculationModule\Infrastructure\Order\Api\OrderInterface;
use Exception;
use RuntimeException;

class DefaultDeliveryConverter extends AbstractConverter
{
    /**
     * @throws Exception
     */
    public function convert(mixed $data, OrderInterface $order): OrderInterface
    {
        try {
            $order->setPrice($data['price']);
            $order->setDate($data['date']);
            $order->setError($data['error']);
        } catch (Exception $e) {
            throw new RuntimeException("Runtime error. {$e->getMessage()}");
        }

        return $order;
    }
}
