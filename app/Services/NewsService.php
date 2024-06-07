<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class NewsService
{
    protected $client;
    protected $apiKey;
    protected $apiHost;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('RAPIDAPI_KEY', '62da37ed0amsh6385db7038bbb71p12d03cjsn3d966127c579');
        $this->apiHost = 'nba-latest-news.p.rapidapi.com';
    }

    public function getNews()
    {
        try {
            $response = $this->client->request('GET', "https://nba-latest-news.p.rapidapi.com/articles", [
                'headers' => [
                    'x-rapidapi-host' => $this->apiHost,
                    'x-rapidapi-key' => $this->apiKey,
                ],
                'verify' => false
            ]);

           return json_decode($response->getBody(), true);
            
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $message = json_decode($response->getBody()->getContents(), true)['message'];

            throw new \Exception("Error fetching news data: $message", $statusCode);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching news data: ' . $e->getMessage(), 500);
        }
    }
}
