<?php

declare(strict_types=1);

namespace Kraken\Tests\Unit\Client;

use Kraken\Tests\TestCase;

class GetDepositStatusTest extends TestCase
{
    function test_success_response()
    {
        $json = <<<EOL
{
  "result":
    {
    "deposits": [
        {
          "method": "Bitcoin",
          "aclass": "string",
          "asset": "XBT",
          "refid": "refid",
          "txid": "txid",
          "info": "info",
          "amount": "0.72485000",
          "fee": "0.00015000",
          "time": 0,
          "status": null,
          "status-prop": "return",
          "originators": [
            "string"
          ]
        }
    ],
    "next_cursor": "cursor"
    },
  "error": []
}
EOL;

        $response = $this->createClient(
            'https://api.kraken.com/0/private/DepositStatus?asset=XBT&method=Bitcoin&nonce=1234567890', $json
        )->getDepositStatus('XBT', 'Bitcoin', 1234567890);

        $this->assertEquals('Bitcoin', $response->deposits[0]->method);
        $this->assertEquals('string', $response->deposits[0]->class);
        $this->assertEquals('XBT', $response->deposits[0]->asset);
        $this->assertEquals('refid', $response->deposits[0]->refId);
        $this->assertEquals('txid', $response->deposits[0]->transactionId);
        $this->assertEquals('info', $response->deposits[0]->info);
        $this->assertEquals('0.72485000', (string) $response->deposits[0]->amount);
        $this->assertEquals('0.00015000', (string) $response->deposits[0]->fee);
        $this->assertEquals(0, $response->deposits[0]->time);
        $this->assertNull($response->deposits[0]->status);
        $this->assertEquals('return', $response->deposits[0]->statusProp);
        $this->assertEquals(['string'], $response->deposits[0]->originators);
        $this->assertEquals('cursor', $response->nextCursor);
    }
}
