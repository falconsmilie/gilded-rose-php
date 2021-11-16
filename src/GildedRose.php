<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Models\Products\AbstractItem;

final class GildedRose
{
    /**
     * @var AbstractItem[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $item->dailyUpdate();
        }
    }
}
