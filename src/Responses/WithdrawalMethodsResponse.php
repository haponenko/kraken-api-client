<?php

declare(strict_types=1);

namespace Butschster\Kraken\Responses;

use JMS\Serializer\Annotation\Type;

class WithdrawalMethodsResponse extends AbstractResponse
{
    /** @Type("array<string, Butschster\Kraken\Responses\Entities\WithdrawalMethods>") */
    public array $result = [];
}
