<?php

namespace GildedRose\Models\Products;

class Conjured extends AbstractItem
{
    protected const QUALITY_DEGRADE_AMOUNT = 2;

    public function updateQuality(): void
    {
        if ($this->quality > 1) {
            $this->quality -= self::QUALITY_DEGRADE_AMOUNT;
        }

        if ($this->quality > self::MAX_QUALITY) {
            $this->quality = self::MAX_QUALITY;
        }
    }

    public function updateSellIn(): void
    {
        $this->sellIn -= 1;

        if ($this->sellIn < 0 && $this->quality > 0) {
            $this->quality -= self::QUALITY_DEGRADE_AMOUNT;
        }
    }
}
