<?php
namespace App\Components\ExampleWeatherIntegration;
use Exception;
use App\Components\ExampleWeatherIntegration\Contracts\ExampleWeatherInterface;
use App\Components\ExampleWeatherIntegration\Exceptions\ExampleWeatherException;

class Client
{
    /**
     * @var exampleWeatherInterface
     */
    protected $exampleWeatherInterface;

    /**
     * Client constructor.
     * @param ExampleWeatherInterface $exampleWeatherInterface
     */
    public function __construct(ExampleWeatherInterface $exampleWeatherInterface)
    {
        $this->exampleWeatherInterface = $exampleWeatherInterface;
    }

    /**
     * @param int $id
     * @return Object
     * @throws ExampleWeatherException
     */
    public function generateWeather(
        int $id
    ): Object {
        try {
            return $this->exampleWeatherInterface->generateWeather(
                $id
            );
        } catch (Exception $exception) {
            throw new ExampleWeatherException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
