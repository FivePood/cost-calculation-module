<?php

use CostCalculationModule\Application\Calculator\Service\Calculator;
use CostCalculationModule\Infrastructure\Delivery\Service\DefaultDeliveryService;
use CostCalculationModule\Infrastructure\Delivery\Service\FastDeliveryService;
use CostCalculationModule\Infrastructure\Delivery\Service\SlowDeliveryService;
use CostCalculationModule\Infrastructure\Request\Service\Request;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $request = new Request('адрес отправителя', 'адрес получателя', 5.0);

    $calculator = new Calculator();

    $fastDelivery = new FastDeliveryService(['base_url' => 'https://fast.delivery']);
    $calculator->addDeliveryService($fastDelivery);
    $slowDelivery = new SlowDeliveryService(['base_url' => 'https://slow.delivery']);
    $calculator->addDeliveryService($slowDelivery);

    $calculator = new Calculator([$fastDelivery, $slowDelivery]);

    $defaultDelivery = new DefaultDeliveryService();
    $calculator->addDeliveryService($defaultDelivery);

    $calculator->removeDeliveryService($defaultDelivery);
    $result = $calculator->calculateForAllDeliveryServices($request);

    $result = $calculator->calculateForDeliveryService($request, $defaultDelivery);

    print_r($result);
} catch (Exception $e) {
    echo "\nRuntime error. {$e->getMessage()}\n";
}
echo "\n";
