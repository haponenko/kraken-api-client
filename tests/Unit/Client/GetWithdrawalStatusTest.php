<?php
declare(strict_types=1);

namespace Kraken\Tests\Unit\Client;

use Kraken\Tests\TestCase;

class GetWithdrawalStatusTest extends TestCase
{
    function test_success_response()
    {
        $json = <<<EOL
{
  "error": [],
  "result": [
    {
      "method": "Bitcoin",
      "aclass": "currency",
      "asset": "XXBT",
      "refid": "AGBZNBO-5P2XSB-RFVF6J",
      "txid": "THVRQM-33VKH-UCI7BS",
      "info": "mzp6yUVMRxfasyfwzTZjjy38dHqMX7Z3GR",
      "amount": "0.72485000",
      "fee": "0.00015000",
      "time": 1617014586,
      "status": "Pending"
    },
    {
      "method": "Bitcoin",
      "aclass": "currency",
      "asset": "XXBT",
      "refid": "AGBSO6T-UFMTTQ-I7KGS6",
      "txid": "KLETXZ-33VKH-UCI7BS",
      "info": "mzp6yUVMRxfasyfwzTZjjy38dHqMX7Z3GR",
      "amount": "0.72485000",
      "fee": "0.00015000",
      "time": 1617015423,
      "status": "Failure",
      "status-prop": "canceled"
    }
  ]
}
EOL;

        $response = $this->createClient(
            'https://api.kraken.com/0/private/WithdrawStatus?asset=XBT&method=Bitcoin&nonce=1234567890', $json
        )->getWithdrawalStatus('XBT', 'Bitcoin');

        $this->assertEquals('Bitcoin', $response[0]->method);
        $this->assertEquals('currency', $response[0]->class);
        $this->assertEquals('XXBT', $response[0]->asset);
        $this->assertEquals('AGBZNBO-5P2XSB-RFVF6J', $response[0]->refId);
        $this->assertEquals('THVRQM-33VKH-UCI7BS', $response[0]->transactionId);
        $this->assertEquals('mzp6yUVMRxfasyfwzTZjjy38dHqMX7Z3GR', $response[0]->info);
        $this->assertEquals('0.72485000', (string) $response[0]->amount);
        $this->assertEquals('0.00015000', (string) $response[0]->fee);
        $this->assertEquals(1617014586, $response[0]->time);
        $this->assertEquals('Pending', $response[0]->status);
        $this->assertNull($response[0]->statusProp);

        $this->assertEquals('Bitcoin', $response[1]->method);
        $this->assertEquals('currency', $response[1]->class);
        $this->assertEquals('XXBT', $response[1]->asset);
        $this->assertEquals('AGBSO6T-UFMTTQ-I7KGS6', $response[1]->refId);
        $this->assertEquals('KLETXZ-33VKH-UCI7BS', $response[1]->transactionId);
        $this->assertEquals('mzp6yUVMRxfasyfwzTZjjy38dHqMX7Z3GR', $response[1]->info);
        $this->assertEquals('0.72485000', (string) $response[1]->amount);
        $this->assertEquals('0.00015000', (string) $response[1]->fee);
        $this->assertEquals(1617015423, $response[1]->time);
        $this->assertEquals('Failure', $response[1]->status);
        $this->assertEquals('canceled', $response[1]->statusProp);
    }

    function test_pending_response()
    {
        $json = <<<EOL
{
  "error": [],
  "result": [
    {
      "method": "Bitcoin",
      "aclass": "currency",
      "asset": "XXBT",
      "refid": "AGBZNBO-5P2XSB-RFVF6J",
      "txid": null,
      "info": "mzp6yUVMRxfasyfwzTZjjy38dHqMX7Z3GR",
      "amount": "0.72485000",
      "fee": "0.00015000",
      "time": 1617014586,
      "status": "Pending"
    },
  ]
}
EOL;

        $response = $this->createClient(
            'https://api.kraken.com/0/private/WithdrawStatus?asset=XBT&method=Bitcoin&nonce=1234567890', $json
        )->getWithdrawalStatus('XBT', 'Bitcoin');

        $this->assertEquals('Bitcoin', $response[0]->method);
        $this->assertEquals('currency', $response[0]->class);
        $this->assertEquals('XXBT', $response[0]->asset);
        $this->assertEquals('AGBZNBO-5P2XSB-RFVF6J', $response[0]->refId);
        $this->assertEquals(null, $response[0]->transactionId);
        $this->assertEquals('mzp6yUVMRxfasyfwzTZjjy38dHqMX7Z3GR', $response[0]->info);
        $this->assertEquals('0.72485000', (string) $response[0]->amount);
        $this->assertEquals('0.00015000', (string) $response[0]->fee);
        $this->assertEquals(1617014586, $response[0]->time);
        $this->assertEquals('Pending', $response[0]->status);
        $this->assertNull($response[0]->statusProp);
    }
}
