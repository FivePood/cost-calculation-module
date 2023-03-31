<?php

declare(strict_types=1);

namespace CostCalculationModule\Infrastructure\Delivery\Service;

use CostCalculationModule\Infrastructure\Request\Api\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait CollectionDataTrait
{
    /**
     * @throws GuzzleException
     */
    public function process(RequestInterface $request): array
    {
        $client = new Client(['base_uri' => $this->url, 'timeout' => 10]);
        $response = $client->get($this->url, [
            'body' => $this->getRequestBody($request)
        ]);

        $responseData = [];
        if ($response->getStatusCode() == 200) {
            $response = $response->getBody()->getContents();
            $responseData = json_decode($response, true);
        }

        return $responseData;
    }

    private function getRequestBody(RequestInterface $request): string
    {
        $body = [
            'sourceKladr' => $request->getSourceKladr(),
            'targetKladr' => $request->getTargetKladr(),
            'weight' => $request->getWeight()
        ];

        return json_encode($body);
    }
}
