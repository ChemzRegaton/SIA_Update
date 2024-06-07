<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GatewayController extends Controller
{
    public function getAllData()
    {
        $news = $this->getNews();
        $googleSearch = $this->googleSearch();
        $weather = $this->getCurrentWeather();
        $quote = $this->getRandomQuote();

        return response()->json([
            'news' => json_decode($news->getBody(), true),
            'google_search' => json_decode($googleSearch->getBody(), true),
            'weather' => json_decode($weather->getBody(), true),
            'quote' => json_decode($quote->getBody(), true),
        ]);
    }

    private function getNews()
    {
        $client = new Client();

        return $client->request('GET', 'https://news-api14.p.rapidapi.com/top-headlines', [
            'headers' => [
                'X-RapidAPI-Host' => 'news-api14.p.rapidapi.com',
                'X-RapidAPI-Key' => '983b4f923emsh17584e3a8986231p1fa806jsnc56a0e308f2d',
            ],
            'query' => [
                'country' => 'us',
                'language' => 'en',
                'pageSize' => 10,
                'category' => 'sports'
            ]
        ]);
    }

    private function googleSearch()
    {
        $client = new Client();

        return $client->request('POST', 'https://google-api31.p.rapidapi.com/websearch', [
            'json' => [
                "text" => "Google",
                "safesearch" => "off",
                "timelimit" => "",
                "region" => "wt-wt",
                "max_results" => 20
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'google-api31.p.rapidapi.com',
                'X-RapidAPI-Key' => '983b4f923emsh17584e3a8986231p1fa806jsnc56a0e308f2d',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    private function getCurrentWeather()
    {
        $client = new Client();

        return $client->request('GET', 'https://ai-weather-by-meteosource.p.rapidapi.com/current', [
            'query' => [
                'lat' => '14.5995', // Latitude for Manila, Philippines
                'lon' => '120.9842', // Longitude for Manila, Philippines
                'timezone' => 'auto',
                'language' => 'en',
                'units' => 'auto',
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'ai-weather-by-meteosource.p.rapidapi.com',
                'X-RapidAPI-Key' => '983b4f923emsh17584e3a8986231p1fa806jsnc56a0e308f2d',
            ],
        ]);
    }

    private function getRandomQuote()
    {
        $client = new Client();

        return $client->request('GET', 'https://get-quotes-api.p.rapidapi.com/random', [
            'headers' => [
                'x-rapidapi-host' => 'get-quotes-api.p.rapidapi.com',
                'x-rapidapi-key' => '4123b0a04dmsh6904a8dcecad229p17ba38jsndcdfb75e3498',
            ],
        ]);
    }
}
