<?php

declare(strict_types=1);

namespace Butschster\Kraken\Responses\Entities;

use JMS\Serializer\Annotation\SerializedName;

class DepositStatus
{
    public Deposit $deposit;

    /**
     * @SerializedName("next_cursor")
     */
    public ?string $nextCursor;
}
