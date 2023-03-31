<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Delivery\Service;

use CostCalculationModule\Infrastructure\Converter\Service\SlowDeliveryConverter;
use CostCalculationModule\Infrastructure\Request\Api\RequestInterface;
use GuzzleHttp\Exception\GuzzleException;

class SlowDeliveryService extends AbstractDeliveryService
{
    use CollectionDataTrait;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->converter = new SlowDeliveryConverter();
    }

    /**
     * @throws GuzzleException
     */
    public function execute(RequestInterface $request): array
    {
        return $this->process($request);
    }
}
