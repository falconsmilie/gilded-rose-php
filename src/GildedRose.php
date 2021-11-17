<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Factories\ItemFactory;
use GildedRose\Models\Products\AbstractItem;

final class GildedRose
{
    /**
     * @var AbstractItem[]
     */
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $this->createItems($items);
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $item->dailyUpdate();
        }
    }

    private function createItems(array $items): array
    {
        foreach ($items as &$item) {
            $item = ItemFactory::create($item);
        }

        return $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
