<?php

declare(strict_types=1);

namespace Butschster\Kraken\Responses\Entities;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class DepositStatus
{
    /** @Type("array<Butschster\Kraken\Responses\Entities\Deposit>") */
    public array $deposits = [];

    /**
     * @SerializedName("next_cursor")
     */
    public ?string $nextCursor;
}
