<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class SearchService
{
    protected $client;
    protected $apiKey;
    protected $apiHost;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('SEARCHAPI_KEY', '62da37ed0amsh6385db7038bbb71p12d03cjsn3d966127c579');
        $this->apiHost = 'google-search74.p.rapidapi.com';
    }

    public function getSearchResults($query)
    {
        try {
            $response = $this->client->request('GET', "https://{$this->apiHost}/?query={$query}&limit=10&related_keywords=true", [
                'headers' => [
                    'x-rapidapi-host' => $this->apiHost,
                    'x-rapidapi-key' => $this->apiKey,
                ],
                'verify' => false
            ]);

            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $message = json_decode($response->getBody()->getContents(), true)['message'];

            throw new \Exception("Error fetching search results: $message", $statusCode);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching search results: ' . $e->getMessage(), 500);
        }
    }
}