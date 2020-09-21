<?php

namespace App\Service;

use App\Entity\WeatherSearch;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;


class WeatherService
{
    private $client;
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->client = HttpClient::create();
        $this->apiKey = $apiKey;
    }

    /**
     * @param WeatherSearch $search
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getWeather(WeatherSearch $search)
    {
        $output = array("content" => null, "error"=> null);
        try {
            $response = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q='. $search->getName() .'&units=metric'.'&appid=' . $this->apiKey .'&lang=fr');
            $output["content"] = json_decode($response->getContent());
        } catch (HttpExceptionInterface $exception) {
            $output["error"] = $exception->getMessage();
        }
        return $output;
    }
}
