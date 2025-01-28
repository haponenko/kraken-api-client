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
  "result": [
    {
        "deposit": {
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
        },
        "next_cursor": "cursor"
    }
  ],
  "error": []
}
EOL;

        $response = $this->createClient(
            'https://api.kraken.com/0/private/DepositStatus?asset=XBT&method=Bitcoin&nonce=1234567890', $json
        )->getDepositStatus('XBT', 'Bitcoin', 1234567890);

        $this->assertEquals('Bitcoin', $response[0]->deposit->method);
        $this->assertEquals('string', $response[0]->deposit->class);
        $this->assertEquals('XBT', $response[0]->deposit->asset);
        $this->assertEquals('refid', $response[0]->deposit->refId);
        $this->assertEquals('txid', $response[0]->deposit->transactionId);
        $this->assertEquals('info', $response[0]->deposit->info);
        $this->assertEquals('0.72485000', (string) $response[0]->deposit->amount);
        $this->assertEquals('0.00015000', (string) $response[0]->deposit->fee);
        $this->assertEquals(0, $response[0]->deposit->time);
        $this->assertNull($response[0]->deposit->status);
        $this->assertEquals('return', $response[0]->deposit->statusProp);
        $this->assertEquals(['string'], $response[0]->deposit->originators);
        $this->assertEquals('cursor', $response[0]->nextCursor);
    }
}
