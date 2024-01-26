<?php

declare(strict_types=1);

namespace CostCalculationModule\Delivery;

use CostCalculationModule\Api\ShippingInterface;
use CostCalculationModule\Converter\DefaultDeliveryConverter;
use GuzzleHttp\Exception\GuzzleException;

class DefaultDeliveryService extends AbstractDeliveryService
{
    use CollectionDataTrait;

    public function __construct()
    {
        parent::__construct();
        $this->url = $this->settings['default']['base_url'];
        $this->converter = new DefaultDeliveryConverter();
    }

    /**
     * @throws GuzzleException
     */
    public function execute(ShippingInterface $shipping): array
    {
        return $this->process($shipping);
    }
}
