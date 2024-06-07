<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class QuoteService
{
    protected $client;
    protected $apiKey;
    protected $apiHost;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = '62da37ed0amsh6385db7038bbb71p12d03cjsn3d966127c579';
        $this->apiHost = 'quotes-inspirational-quotes-motivational-quotes.p.rapidapi.com';
    }

    public function getRandomQuote()
    {
        try {
            $response = $this->client->request('GET', "https://{$this->apiHost}/quote?token=ipworld.info", [
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

            throw new \Exception("Error fetching quote: $message", $statusCode);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching quote: ' . $e->getMessage(), 500);
        }
    }
}