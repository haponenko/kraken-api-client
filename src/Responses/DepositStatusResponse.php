<?php

declare(strict_types=1);

namespace Butschster\Kraken\Responses;

use Butschster\Kraken\Responses\Entities\DepositStatus;

class DepositStatusResponse extends AbstractResponse
{
    public ?DepositStatus $result = null;
}
