<?php

declare(strict_types=1);

namespace CostCalculationModule\Delivery;

use CostCalculationModule\Api\ConverterInterface;
use CostCalculationModule\Api\DeliveryServiceInterface;
use CostCalculationModule\Api\ShippingInterface;
use Symfony\Component\Yaml\Yaml;

abstract class AbstractDeliveryService implements DeliveryServiceInterface
{
    protected ConverterInterface $converter;
    protected string $url = '';
    public array $settings = [];

    public function __construct()
    {
        $this->settings = $this->getSettings();
    }

    abstract public function execute(ShippingInterface $shipping): mixed;

    public function getConverter(): ConverterInterface
    {
        return $this->converter;
    }

    private function getSettings(): array
    {
        $settings = YAML::parseFile(__DIR__ . '/../../config/settings.yml');
        return is_array($settings) ? $settings : [];
    }
}
