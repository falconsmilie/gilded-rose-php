<?php

declare(strict_types=1);

namespace GildedRose\Models;

class BackStagePass extends AbstractItem implements ItemInterface
{
    public function updateQuality(): void
    {
        if ($this->sellIn < 0) {
            $this->quality = 0;
            return;
        }

        if ($this->quality < 50) {
            if ($this->sellIn <= 5) {
                $this->quality += 5;
            } elseif ($this->sellIn <= 10) {
                $this->quality += 3;
            } else {
                $this->quality += 1;
            }
        }
    }

    public function updateSellIn(): void
    {
        $this->sellIn -= 1;
    }
}
