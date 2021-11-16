<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\Models\AgedBrie;
use GildedRose\Models\BackStagePass;
use GildedRose\Models\ItemInterface;
use GildedRose\Models\StandardItem;
use GildedRose\Models\Sulfuras;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
//    public function testFoo(): void
//    {
//        $items = [new Item('foo', 0, 0)];
//        $gildedRose = new GildedRose($items);
//        $gildedRose->updateQuality();
//        $this->assertSame('foo', $items[0]->name);
//    }

    public function updateQualityDataProvider(): array
    {
        // $name, $sellIn, $expectedSellIn, $quality, $expectedQuality
        return [
            [StandardItem::class, '+5 Dexterity Vest', 10, 9, 20, 19],
            [StandardItem::class, '+5 Dexterity Vest', 0, -1, 20, 18],
            [AgedBrie::class, 'Aged Brie', 2, 1, 2, 3],
            [AgedBrie::class, 'Aged Brie', -2, -3, 2, 4],
            [StandardItem::class, 'Elixir of the Mongoose', 5, 4, 7, 6],
            [StandardItem::class, 'Elixir of the Mongoose', -5, -6, 7, 5],
            [StandardItem::class, 'Elixir of the Mongoose', 5, 4, 80, 50],
            [Sulfuras::class, 'Sulfuras, Hand of Ragnaros', 2, 2, 80, 80],
            [Sulfuras::class, 'Sulfuras, Hand of Ragnaros', -2, -2, 80, 80],
            [Sulfuras::class, 'Sulfuras, Hand of Ragnaros', 2, 2, 20, 20],
            [Sulfuras::class, 'Sulfuras, Hand of Ragnaros', -2, -2, 20, 20],
            [BackStagePass::class, 'Backstage passes to a TAFKAL80ETC concert', 15, 14, 20, 21],
            [BackStagePass::class, 'Backstage passes to a TAFKAL80ETC concert', 0, -1, 20, 0],
            [BackStagePass::class, 'Backstage passes to a TAFKAL80ETC concert', -10, -11, 50, 0],
            [BackStagePass::class, 'Backstage passes to a TAFKAL80ETC concert', -10, -11, 150, 0],
            [BackStagePass::class, 'Backstage passes to a TAFKAL80ETC concert', 10, 9, 48, 50],
            [BackStagePass::class, 'Backstage passes to a TAFKAL80ETC concert', 10, 9, 49, 50],
            [BackStagePass::class, 'Backstage passes to a TAFKAL80ETC concert', 5, 4, 49, 50],
            [BackStagePass::class, 'Backstage passes to a TAFKAL80ETC concert', 5, 4, 47, 50],
        ];
    }

    /**
     * @dataProvider updateQualityDataProvider
     * @param string $type
     * @param string $name
     * @param int $sellIn
     * @param int $expectedSellIn
     * @param int $quality
     * @param int $expectedQuality
     */
    public function testUpdateQuality(
        string $type,
        string $name,
        int $sellIn,
        int $expectedSellIn,
        int $quality,
        int $expectedQuality
    ): void {
        /** @var array[ItemInterface] $items */
        $items = [new $type($name, $quality, $sellIn)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($expectedQuality, $items[0]->quality);
        $this->assertSame($expectedSellIn, $items[0]->sellIn);
    }
}
