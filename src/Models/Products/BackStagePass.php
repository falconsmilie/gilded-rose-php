<?php

declare(strict_types=1);

namespace GildedRose\Models\Products;

class BackStagePass extends AbstractItem
{
    public function updateQuality(): void
    {
        if ($this->sellIn <= 0) {
            $this->quality = 0;
            return;
        }

        if ($this->quality < self::MAX_QUALITY) {
            if ($this->sellIn <= 5) {
                $this->quality += 5;
            } elseif ($this->sellIn <= 10) {
                $this->quality += 3;
            } else {
                $this->quality += 1;
            }
        }

        if ($this->quality > self::MAX_QUALITY) {
            $this->quality = self::MAX_QUALITY;
        }
    }

    public function updateSellIn(): void
    {
        $this->sellIn -= 1;
    }
}
