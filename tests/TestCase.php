<?php

declare(strict_types=1);

namespace Kraken\Tests;

use Butschster\Kraken\Client;
use Butschster\Kraken\Contracts\NonceGenerator;
use Butschster\Kraken\Serializer\SerializerFactory;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Mockery as m;

class TestCase extends BaseTestCase
{
    public function createClient(string $urlWithQueryString, string $json): Client
    {
        Http::fake([
            explode('?', $urlWithQueryString)[0] => Http::response($json),
        ]);

        $nonce = m::mock(NonceGenerator::class);
        $nonce->shouldReceive('generate')->andReturn(1234567890);

        return new Client(
            $nonce,
            (new SerializerFactory())->build(),
            'api-key',
            'api-secret'
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        m::close();
    }
}
