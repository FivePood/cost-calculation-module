<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Delivery\Service;

use CostCalculationModule\Infrastructure\Converter\Api\ConverterInterface;
use CostCalculationModule\Infrastructure\Delivery\Api\DeliveryServiceInterface;
use CostCalculationModule\Infrastructure\Request\Api\RequestInterface;

abstract class AbstractDeliveryService implements DeliveryServiceInterface
{
    protected ConverterInterface $converter;
    protected string $url = '';

    public function __construct(array $config = [])
    {
        $this->url = $config['base_url'] ?? $this->url;
    }

    abstract public function execute(RequestInterface $request): mixed;

    public function getConverter(): ConverterInterface
    {
        return $this->converter;
    }
}
