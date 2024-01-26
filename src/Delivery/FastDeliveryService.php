<?php

declare(strict_types=1);

namespace CostCalculationModule\Delivery;

use CostCalculationModule\Api\ShippingInterface;
use CostCalculationModule\Converter\FastDeliveryConverter;
use GuzzleHttp\Exception\GuzzleException;

class FastDeliveryService extends AbstractDeliveryService
{
    use CollectionDataTrait;

    public function __construct()
    {
        parent::__construct();
        $this->url = $this->settings['fast']['base_url'];
        $this->converter = new FastDeliveryConverter();
    }

    /**
     * @throws GuzzleException
     */
    public function execute(ShippingInterface $shipping): array
    {
        return $this->process($shipping);
    }
}
