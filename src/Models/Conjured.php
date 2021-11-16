<?php

namespace GildedRose\Models;

class Conjured extends AbstractItem implements ItemInterface
{

    public function updateQuality(): void
    {
        if ($this->quality > 1) {
            $this->quality -= 2;
        }
    }

    public function updateSellIn(): void
    {
        // TODO: Implement updateSellIn() method.
    }
}
