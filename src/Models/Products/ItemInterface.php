<?php

declare(strict_types=1);

namespace GildedRose\Models\Products;

interface ItemInterface
{
    public function updateQuality(): void;

    public function updateSellIn(): void;
}
