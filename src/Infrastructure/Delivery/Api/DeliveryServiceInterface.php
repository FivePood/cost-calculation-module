<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Delivery\Api;

use CostCalculationModule\Infrastructure\Converter\Api\ConverterInterface;
use CostCalculationModule\Infrastructure\Request\Api\RequestInterface;

interface DeliveryServiceInterface
{
    public function execute(RequestInterface $request): mixed;

    public function getConverter(): ConverterInterface;
}
