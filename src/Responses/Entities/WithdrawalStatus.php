<?php

declare(strict_types=1);

namespace Butschster\Kraken\Responses\Entities;

use Brick\Math\BigDecimal;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Accessor;

class WithdrawalStatus
{
    /**
     * Name of withdrawal method
     * @Type("string")
     */
    public string $method;

    /**
     * Asset class
     * @SerializedName("aclass")
     */
    public string $class;

    /**
     * Asset
     * @Type("string")
     */
    public string $asset;

    /**
     * Reference ID
     * @Type("string")
     * @SerializedName("refid")
     */
    public string $refId;

    /**
     * Method transaction ID
     * @Type("string")
     * @SerializedName("txid")
     */
    public ?string $transactionId = null;

    /**
     * Method transaction information
     * @Type("string")
     */
    public string $info;

    /**
     * Amount withdrawn
     * @Type("BigDecimal")
     */
    public BigDecimal $amount;

    /**
     * Fees paid
     * @Type("BigDecimal")
     */
    public ?BigDecimal $fee = null;

    /**
     * Unix timestamp when request was made
     * @Type("int")
     */
    public int $time = 0;

    /**
     * Status of withdraw
     * @Type("string")
     */
    public string $status;

    /**
     * Addition status properties
     * @Type("string")
     * @SerializedName("status-prop")
     */
    public ?string $statusProp = null;
}
