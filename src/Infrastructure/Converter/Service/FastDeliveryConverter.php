<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Converter\Service;

use CostCalculationModule\Infrastructure\Order\Api\OrderInterface;
use DateTime;
use Exception;
use RuntimeException;

class FastDeliveryConverter extends AbstractConverter
{
    private const END_TIME = '18:00';

    /**
     * @throws Exception
     */
    public function convert(mixed $data, OrderInterface $order): OrderInterface
    {
        try {
            $date = new DateTime();
            $period = $date->format('H:i') >= self::END_TIME ? 1 + $data['period'] : $data['period'];
            $date->modify('+' . $period . 'days');
            $order->setPrice($data['price']);
            $order->setDate($date->format('Y-m-d'));
            $order->setError($data['error']);
        } catch (Exception $e) {
            throw new RuntimeException("Runtime error. {$e->getMessage()}");
        }

        return $order;
    }
}
