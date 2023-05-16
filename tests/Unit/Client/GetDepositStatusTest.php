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
  "error": []
}
EOL;

        $response = $this->createClient(
            'https://api.kraken.com/0/private/DepositStatus?asset=XBT&method=Bitcoin&nonce=1234567890', $json
        )->getDepositStatus('XBT', 'Bitcoin');

        $this->assertEquals('Bitcoin', $response[0]->method);
        $this->assertEquals('string', $response[0]->class);
        $this->assertEquals('XBT', $response[0]->asset);
        $this->assertEquals('refid', $response[0]->refId);
        $this->assertEquals('txid', $response[0]->transactionId);
        $this->assertEquals('info', $response[0]->info);
        $this->assertEquals('0.72485000', (string) $response[0]->amount);
        $this->assertEquals('0.00015000', (string) $response[0]->fee);
        $this->assertEquals(0, $response[0]->time);
        $this->assertNull($response[0]->status);
        $this->assertEquals('return', $response[0]->statusProp);
        $this->assertEquals(['string'], $response[0]->originators);
    }
}
