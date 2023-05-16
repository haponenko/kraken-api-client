<?php
declare(strict_types=1);

namespace Butschster\Kraken\Responses;

use JMS\Serializer\Annotation\Type;

class DepositStatusResponse extends AbstractResponse
{
    /** @Type("array<string, Butschster\Kraken\Responses\Entities\DepositStatus>") */
    public array $result = [];
}
