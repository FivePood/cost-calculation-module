<?php

use CostCalculationModule\Delivery\DefaultDeliveryService;
use CostCalculationModule\Delivery\FastDeliveryService;
use CostCalculationModule\Delivery\SlowDeliveryService;
use CostCalculationModule\Service\CalculatorDelivery;
use CostCalculationModule\Service\Shipping;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $calculator = new CalculatorDelivery();

    $defaultDelivery = new DefaultDeliveryService();
    $calculator->addDeliveryService($defaultDelivery);
    $calculator->removeDeliveryService($defaultDelivery);

    $fastDelivery = new FastDeliveryService();
    $slowDelivery = new SlowDeliveryService();
    $calculator = new CalculatorDelivery([$fastDelivery, $slowDelivery]);

    $shipping = new Shipping(
        'г Москва, улица Соловьева, дом 1',
        'г Москва, улица Советская, дом 1',
        5.0
    );

    $result = $calculator->calculateForDeliveryService($shipping, $fastDelivery);
    $result = $calculator->calculateForDeliveryService($shipping, $slowDelivery);

    $result = $calculator->calculateForAllDeliveryServices($shipping);
    print_r($result->getOrders());

} catch (Exception $e) {
    echo "\nRuntime error. {$e->getMessage()}\n";
}
echo "\n";
