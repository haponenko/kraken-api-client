<?php

declare(strict_types=1);

namespace Butschster\Kraken\ValueObjects;

class AssetPair
{
    public function __construct(
        private readonly string $asset1,
        private readonly string $asset2
    ) {
    }

    public function getAsset1(): string
    {
        return $this->asset1;
    }

    public function getAsset2(): string
    {
        return $this->asset2;
    }

    public function __toString(): string
    {
        return sprintf('%s/%s', $this->asset1, $this->asset2);
    }
}