<?php

namespace GildedRose\Models\Products;

class Sulfuras extends AbstractItem
{
    protected const QUALITY_DEGRADE_AMOUNT = 0;
    protected const MAX_QUALITY = 80;

    public function updateQuality(): void
    {
        $this->quality = self::MAX_QUALITY;
    }

    public function updateSellIn(): void
    {
        $this->quality -= self::QUALITY_DEGRADE_AMOUNT;
    }
}
