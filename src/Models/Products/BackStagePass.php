<?php

declare(strict_types=1);

namespace GildedRose\Models\Products;

/**
 * "Backstage passes" increases in Quality as its SellIn value approaches;
 *      Quality increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but
 *      Quality drops to 0 after the concert
 * The Quality of an item is never negative
 * The Quality of an item is never more than 50
 */
class BackStagePass extends AbstractItem
{
    public function updateQuality(): void
    {
        if ($this->sellIn - 1 <= 0) {
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
