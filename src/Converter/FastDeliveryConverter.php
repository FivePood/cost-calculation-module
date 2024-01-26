<?php

declare(strict_types=1);

namespace CostCalculationModule\Converter;

use CostCalculationModule\Api\DeliveryServiceInterface;
use CostCalculationModule\Api\OrderInterface;
use DateTime;
use Exception;
use RuntimeException;

class FastDeliveryConverter extends AbstractConverter
{
    /**
     * @throws Exception
     */
    public function convert(mixed $data, DeliveryServiceInterface $deliveryService, OrderInterface $order): OrderInterface
    {
        try {
            $date = new DateTime();
            $endTime = $deliveryService->settings['fast']['end_time'];
            $period = $date->format('H:i') >= $endTime ? 1 + $data['period'] : $data['period'];
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
