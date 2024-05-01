<?php

declare(strict_types=1);

namespace Butschster\Kraken\Responses\Entities;

use JMS\Serializer\Annotation\Type;

class WithdrawalMethods
{
    /**
     * Name of asset being withdrawn
     * @Type("string")
     */
    public string $asset;

    /**
     * Name of the withdrawal method
     * @Type("string")
     */
    public string $method;

    /**
     * Name of the blockchain or network being withdrawn on
     * @Type("string")
     */
    public string $network;

    /**
     * Minimum net amount that can be withdrawn right now
     * @Type("string")
     */
    public string $minimum;
}
