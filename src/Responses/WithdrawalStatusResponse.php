<?php
declare(strict_types=1);

namespace Butschster\Kraken\Responses;

use JMS\Serializer\Annotation\Type;

class WithdrawalStatusResponse extends AbstractResponse
{
    /** @Type("array<string, Butschster\Kraken\Responses\Entities\WithdrawalStatus>") */
    public array $result = [];
}
