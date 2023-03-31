<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Converter\Service;

use CostCalculationModule\Infrastructure\Order\Api\OrderInterface;
use Exception;
use RuntimeException;

class SlowDeliveryConverter extends AbstractConverter
{
    private const BASE_PRICE = 150;

    /**
     * @throws Exception
     */
    public function convert(mixed $data, OrderInterface $order): OrderInterface
    {
        try {
            $coefficient = $data['coefficient'] ?: 1;
            $order->setPrice($coefficient * self::BASE_PRICE);
            $order->setDate($data['date']);
            $order->setError($data['error']);
        } catch (Exception $e) {
            throw new RuntimeException("Runtime error. {$e->getMessage()}");
        }

        return $order;
    }
}
