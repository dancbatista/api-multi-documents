<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use App\Components\ExampleWeatherIntegration\Client;
use App\Components\ExampleWeatherIntegration\Strategies\ExampleWeatherStrategy;

class ExampleWeatherProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {        
        $this->app->singleton(Client::class, function () {
            $config = config('exampleweather');
            $client = new GuzzleClient([
                'base_uri' => $config['base_uri'],
            ]);
             
            return new Client(new ExampleWeatherStrategy($client));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
