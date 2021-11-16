<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\Models\Products\AgedBrie;
use GildedRose\Models\Products\BackStagePass;
use GildedRose\Models\Products\Conjured;
use GildedRose\Models\Products\StandardItem;
use GildedRose\Models\Products\Sulfuras;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function updateQualityDataProvider(): array
    {
        // $type, $item, $expectedSellIn, $expectedQuality
        return [
            [StandardItem::class, new Item('+5 Dexterity Vest', 10, 20), 9, 19],
            [StandardItem::class, new Item('+5 Dexterity Vest', 0, 20), -1, 18],
            [AgedBrie::class, new Item('Aged Brie', 2, 2), 1, 3],
            [AgedBrie::class, new Item('Aged Brie', -2, 2), -3, 4],
            [StandardItem::class, new Item('Elixir of the Mongoose', 5, 7), 4, 6],
            [StandardItem::class, new Item('Elixir of the Mongoose', -5, 7), -6, 5],
            [StandardItem::class, new Item('Elixir of the Mongoose', 5, 80), 4, 50],
            [Sulfuras::class, new Item('Sulfuras, Hand of Ragnaros', 2, 80), 2, 80],
            [Sulfuras::class, new Item('Sulfuras, Hand of Ragnaros', -2, 80), -2, 80],
            [Sulfuras::class, new Item('Sulfuras, Hand of Ragnaros', 2, 20), 2, 20],
            [Sulfuras::class, new Item('Sulfuras, Hand of Ragnaros', -2, 20), -2, 20],
            [BackStagePass::class, new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20), 14, 21],
            [BackStagePass::class, new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20), -1, 0],
            [BackStagePass::class, new Item('Backstage passes to a TAFKAL80ETC concert', -10, 50), -11, 0],
            [BackStagePass::class, new Item('Backstage passes to a TAFKAL80ETC concert', -10, 150), -11, 0],
            [BackStagePass::class, new Item('Backstage passes to a TAFKAL80ETC concert', 10, 48), 9, 50],
            [BackStagePass::class, new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49), 9, 50],
            [BackStagePass::class, new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49), 4, 50],
            [BackStagePass::class, new Item('Backstage passes to a TAFKAL80ETC concert', 5, 47), 4, 50],
            [Conjured::class, new Item('Conjured', 5, 47), 4, 45],
            [Conjured::class, new Item('Conjured', 5, 80), 4, 50],
            [Conjured::class, new Item('Conjured', -5, 10), -6, 6],
        ];
    }

    /**
     * @dataProvider updateQualityDataProvider
     * @param string $type
     * @param Item $item
     * @param int $expectedSellIn
     * @param int $expectedQuality
     */
    public function testUpdateQuality(
        string $type,
        Item $item,
        int $expectedSellIn,
        int $expectedQuality
    ): void {
        /** @var array[ItemInterface] $items */
        $items = [new $type($item)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($expectedQuality, $items[0]->getQuality());
        $this->assertSame($expectedSellIn, $items[0]->getSellIn());
    }
}
