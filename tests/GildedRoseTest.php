<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function updateQualityDataProvider(): array
    {
        // $name, $sellIn, $expectedSellIn, $quality, $expectedQuality
        return [
            ['+5 Dexterity Vest', 10, 9, 20, 19],
            ['+5 Dexterity Vest', 0, -1, 20, 18],
            ['Aged Brie', 2, 1, 2, 3],
            ['Aged Brie', -2, -3, 2, 4],
            ['Elixir of the Mongoose', 5, 4, 7, 6],
            ['Elixir of the Mongoose', -5, -6, 7, 5],
            ['Sulfuras, Hand of Ragnaros', 2, 2, 80, 50],
            ['Sulfuras, Hand of Ragnaros', -2, -2, 80, 50],
            ['Sulfuras, Hand of Ragnaros', 2, 2, 20, 20],
            ['Sulfuras, Hand of Ragnaros', -2, -2, 20, 20],
            ['Backstage passes to a TAFKAL80ETC concert', 15, 14, 20, 21],
            ['Backstage passes to a TAFKAL80ETC concert', 0, -1, 20, 0],
            ['Backstage passes to a TAFKAL80ETC concert', -10, -11, 50, 0],
            ['Backstage passes to a TAFKAL80ETC concert', -10, -11, 150, 0],
            ['Backstage passes to a TAFKAL80ETC concert', 10, 9, 48, 50],
            ['Backstage passes to a TAFKAL80ETC concert', 10, 9, 49, 50],
            ['Backstage passes to a TAFKAL80ETC concert', 5, 4, 49, 50],
            ['Backstage passes to a TAFKAL80ETC concert', 5, 4, 47, 50],
        ];
    }

    /**
     * @dataProvider updateQualityDataProvider
     * @param string $name
     * @param int $sellIn
     * @param int $expectedSellIn
     * @param int $quality
     * @param int $expectedQuality
     */
    public function testUpdateQuality(
        string $name,
        int $sellIn,
        int $expectedSellIn,
        int $quality,
        int $expectedQuality
    ): void {
        $items = [new Item($name, $sellIn, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($expectedQuality, $items[0]->quality);
        $this->assertSame($expectedSellIn, $items[0]->sell_in);
    }
}
