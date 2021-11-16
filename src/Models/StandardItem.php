<?php

declare(strict_types=1);

namespace GildedRose\Models;

class StandardItem extends AbstractItem implements ItemInterface
{
    public function updateQuality(): void
    {
        if ($this->quality > self::MAX_QUALITY) {
            $this->quality = self::MAX_QUALITY;
        }

        if ($this->quality > 0) {
            $this->quality = $this->quality - 1;
        }
    }

    public function updateSellIn(): void
    {
        $this->sellIn -= 1;

        if ($this->sellIn < 0 && $this->quality > 0) {
            $this->quality -= 1;
        }
    }
}
