<?php

declare(strict_types=1);

namespace GildedRose\Models\Products;

use GildedRose\Item;

abstract class AbstractItem
{
    protected const MAX_QUALITY = 50;
    protected const QUALITY_DEGRADE_AMOUNT = 1;

    protected int $quality;
    protected int $sellIn;
    protected string $name;

    public function __construct(Item $item)
    {
        $this->quality = $item->quality;
        $this->sellIn = $item->sell_in;
        $this->name = $item->name;
    }

    abstract protected function updateQuality(): void;
    abstract protected function updateSellIn(): void;

    public function dailyUpdate(): void
    {
        $this->updateQuality();
        $this->updateSellIn();
    }

    public function __toString(): string
    {
        return $this->name . ', ' . $this->sellIn . ', ' . $this->quality;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function getSellIn(): int
    {
        return $this->sellIn;
    }
}
