<?php

declare(strict_types=1);

namespace GildedRose\Models\Products;

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

    public function updateSellIn(): void
    {
        $this->sellIn -= 1;

        if ($this->sellIn < 0 && $this->quality > 0) {
            $this->quality -= self::QUALITY_DEGRADE_AMOUNT;
        }
    }
}
