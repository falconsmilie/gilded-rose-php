<?php

namespace GildedRose\Models\Products;

/**
 * "Conjured" items degrade in Quality twice as fast as normal items
 * The Quality of an item is never negative
 * The Quality of an item is never more than 50
 */
class Conjured extends AbstractItem
{
    protected const QUALITY_DEGRADE_AMOUNT = 2;

    protected function updateQuality(): void
    {
        if ($this->quality > 1) {
            $this->quality -= self::QUALITY_DEGRADE_AMOUNT;
        }

        if ($this->quality > self::MAX_QUALITY) {
            $this->quality = self::MAX_QUALITY;
        }
    }

    protected function updateSellIn(): void
    {
        $this->sellIn -= 1;

        if ($this->sellIn < 0 && $this->quality > 0) {
            $this->quality -= self::QUALITY_DEGRADE_AMOUNT;
            if ($this->quality < 0) {
                $this->quality = 0;
            }
        }
    }
}
