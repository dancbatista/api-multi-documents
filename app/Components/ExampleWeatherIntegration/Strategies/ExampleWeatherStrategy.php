<?php

namespace App\Components\ExampleWeatherIntegration\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\ExampleWeatherIntegration\Contracts\ExampleWeatherInterface;
use App\Components\ExampleWeatherIntegration\Exceptions\ExampleWeatherException;

class ExampleWeatherStrategy implements ExampleWeatherInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * ExampleWeatherStrategy constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $id
     * @return Object
     * @throws Exception
     */
    public function generateWeather(
    int $id
    ): Object
    {
        try {
             
            $response = $this->client->request('GET', '?woeid='.$id , [
                'json' => '',
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());

            throw new ExampleWeatherException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}
