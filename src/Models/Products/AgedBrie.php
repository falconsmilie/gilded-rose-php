<?php

declare(strict_types=1);

namespace GildedRose\Models\Products;

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
