<?php

declare(strict_types=1);

namespace GildedRose\Models\Products;

/**
 * "Aged Brie" actually increases in Quality the older it gets
 * The Quality of an item is never more than 50
 */
class AgedBrie extends AbstractItem
{
    public function updateQuality(): void
    {
        if ($this->quality < self::MAX_QUALITY) {
            $this->quality += 1;
        }
    }

    public function updateSellIn(): void
    {
        $this->sellIn -= 1;

        if ($this->sellIn < 0 && $this->quality < self::MAX_QUALITY) {
            $this->quality += 1;
        }
    }
}
