<?php

declare(strict_types=1);

namespace CostCalculationModule\Delivery;

use CostCalculationModule\Api\ShippingInterface;
use CostCalculationModule\Converter\SlowDeliveryConverter;
use GuzzleHttp\Exception\GuzzleException;

class SlowDeliveryService extends AbstractDeliveryService
{
    use CollectionDataTrait;

    protected int $basePrice;

    public function __construct()
    {
        parent::__construct();
        $this->url = $this->settings['slow']['base_url'];
        $this->basePrice = $this->settings['slow']['price'];
        $this->converter = new SlowDeliveryConverter();
    }

    /**
     * @throws GuzzleException
     */
    public function execute(ShippingInterface $shipping): array
    {
        return $this->process($shipping);
    }
}
