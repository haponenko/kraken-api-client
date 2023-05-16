<?php
declare(strict_types=1);

namespace Butschster\Kraken\Responses\Entities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Withdraw
{
    /**
     * Reference ID
     * @Type("string")
     * @SerializedName("refid")
     */
    public string $refId;
}
