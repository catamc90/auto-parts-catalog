<?php

namespace App\Api;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RapidBaseApi
{
    private HttpClientInterface $client;
    private string $rapidApiKey;
    private string $rapidApiBaseUrl;

    public function __construct(HttpClientInterface $client)
    {
        // Initialize HttpClient
        $this->client = $client;

        // Set RapidAPI credentials from .env
        $this->rapidApiKey = $_ENV['RAPIDAPI_KEY'];
        $this->rapidApiBaseUrl = $_ENV['RAPIDAPI_BASE_URL'];
    }

    public function fetchData($endpoint, $params = [])
    {
        // Make API request to RapidAPI
        try {
            $response = $this->client->request('GET', $this->rapidApiBaseUrl.$endpoint, [
                'headers' => [
                    'x-rapidapi-key' => $this->rapidApiKey,
                    'x-rapidapi-host' => parse_url($this->rapidApiBaseUrl, PHP_URL_HOST),
                ],
                'query' => $params,  // optional query parameters
            ]);

            // Return response content as an array or object
            return $response->toArray();
        } catch (\Exception $e) {
            // Handle exceptions
            return ['error' => 'Failed to connect to API: '.$e->getMessage()];
        }
    }
}
