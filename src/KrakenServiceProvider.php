<?php

declare(strict_types=1);

namespace Butschster\Kraken;

use Butschster\Kraken\Serializer\SerializerFactory;
use Illuminate\Support\ServiceProvider;
use React\EventLoop\Factory;

class KrakenServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerClient();
    }

    public function register()
    {
        $configPath = __DIR__ . '/../config/kraken.php';
        $this->mergeConfigFrom($configPath, 'kraken');
    }

    protected function registerClient(): void
    {
        $this->app->singleton(Contracts\Client::class, function () {
            $config = $this->app->make('config')->get('kraken', []);

            return new Client(
                new NonceGenerator(),
                (new SerializerFactory())->build(),
                $config['key'] ?? null,
                $config['secret'] ?? null,
                $config['otp'] ?? null
            );
        });

        $this->app->bind(Contracts\WebsocketClient::class, function () {
            $config = $this->app->make('config')->get('kraken', []);

            return new WebsocketClient(
                (new SerializerFactory())->build(),
                Factory::create(),
                $config['websocket_headers'] ?? []
            );
        });
    }
}
