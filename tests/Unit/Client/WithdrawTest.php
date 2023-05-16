<?php
declare(strict_types=1);

namespace Kraken\Tests\Unit\Client;

use Brick\Math\BigDecimal;
use Kraken\Tests\TestCase;

class WithdrawTest extends TestCase
{
    function test_success_response()
    {
        $json = <<<EOL
{
  "error": [],
  "result": {
    "refid": "AGBSO6T-UFMTTQ-I7KGS6"
  }
}
EOL;

        $response = $this->createClient(
            'https://api.kraken.com/0/private/Withdraw?asset=XBT&key=btc_testnet_with1&amount=0.725&nonce=1234567890', $json
        )->withdraw('XBT', 'btc_testnet_with1', BigDecimal::of(0.725));

        $this->assertEquals('AGBSO6T-UFMTTQ-I7KGS6', $response->refId);
    }
}
