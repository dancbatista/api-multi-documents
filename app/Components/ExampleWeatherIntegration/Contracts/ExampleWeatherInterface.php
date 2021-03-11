<?php

namespace App\Components\ExampleWeatherIntegration\Contracts;

interface ExampleWeatherInterface
{

    /**
     * @param int $id
     * @return Object
     */
    public function generateWeather(
        int $id
    ): Object;
}
