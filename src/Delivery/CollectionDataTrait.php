<?php

declare(strict_types=1);

namespace CostCalculationModule\Delivery;

use CostCalculationModule\Api\ShippingInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait CollectionDataTrait
{
    /**
     * @throws GuzzleException
     */
    public function process(ShippingInterface $shipping): array
    {
        $client = new Client(['base_uri' => $this->url, 'timeout' => 30]);
        $response = $client->get($this->url, [
            'body' => $this->getRequestBody($shipping)
        ]);

        $responseData = [];
        if ($response->getStatusCode() == 200) {
            $response = $response->getBody()->getContents();
            $responseData = json_decode($response, true);
        }

        return $responseData;
    }

    private function getRequestBody(ShippingInterface $shipping): string
    {
        $body = [
            'sourceKladr' => $shipping->getSourceKladr(),
            'targetKladr' => $shipping->getTargetKladr(),
            'weight' => $shipping->getWeight()
        ];

        return json_encode($body);
    }
}
