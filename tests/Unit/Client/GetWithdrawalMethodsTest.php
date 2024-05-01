<?php

declare(strict_types=1);

namespace Kraken\Tests\Unit\Client;

use Kraken\Tests\TestCase;

class GetWithdrawalMethodsTest extends TestCase
{
    function test_success_response()
    {
        $json = <<<EOL
{
  "error": [],
  "result": [
    {
      "asset": "XXBT",
      "method": "Bitcoin",
      "network": "Bitcoin",
      "minimum": "0.0004"
    },
    {
      "asset": "XXBT",
      "method": "Bitcoin Lightning",
      "network": "Lightning",
      "minimum": "0.00001"
    }
  ]
}
EOL;

        $response = $this->createClient(
            'https://api.kraken.com/0/private/WithdrawMethods?asset=XXBT&nonce=1234567890', $json
        )->getWithdrawalMethods('XXBT');

        $this->assertEquals('XXBT', $response[0]->asset);
        $this->assertEquals('Bitcoin', $response[0]->method);
        $this->assertEquals('Bitcoin', $response[0]->network);
        $this->assertEquals('0.0004', $response[0]->minimum);

        $this->assertEquals('XXBT', $response[1]->asset);
        $this->assertEquals('Bitcoin Lightning', $response[1]->method);
        $this->assertEquals('Lightning', $response[1]->network);
        $this->assertEquals('0.00001', $response[1]->minimum);
    }
}
