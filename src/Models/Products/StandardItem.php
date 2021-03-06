<?php

declare(strict_types=1);

namespace GildedRose\Models\Products;

/**
 * Once the sell by date has passed, Quality degrades twice as fast
 * The Quality of an item is never negative
 * The Quality of an item is never more than 50
 */
class StandardItem extends AbstractItem
{
    protected function updateQuality(): void
    {
        if ($this->quality > 0) {
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
        }
    }
}
