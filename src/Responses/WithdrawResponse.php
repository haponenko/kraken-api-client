<?php
declare(strict_types=1);

namespace Butschster\Kraken\Responses;

use Butschster\Kraken\Responses\Entities\Withdraw;

class WithdrawResponse extends AbstractResponse
{
    public ?Withdraw $result = null;
}
