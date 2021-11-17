<?php

namespace GildedRose\Models\Products;

/**
 * "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
 */
class Sulfuras extends AbstractItem
{
    protected const QUALITY_DEGRADE_AMOUNT = 0;
    protected const MAX_QUALITY = 80;
    private const SELL_IN_DEFAULT = 100;

    public function updateQuality(): void
    {
        $this->quality = self::MAX_QUALITY;
    }

    public function updateSellIn(): void
    {
        $this->sellIn = self::SELL_IN_DEFAULT;
    }
}
