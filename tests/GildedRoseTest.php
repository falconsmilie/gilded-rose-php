<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function updateQualityDataProvider(): array
    {
        // $type, $item, $expectedSellIn, $expectedQuality
        return [
            [[new Item('+5 Dexterity Vest', 10, 20)], 9, 19],
            [[new Item('+5 Dexterity Vest', 0, 20)], -1, 18],
            [[new Item('Aged Brie', 2, 2)], 1, 3],
            [[new Item('Aged Brie', -2, 2)], -3, 4],
            [[new Item('Elixir of the Mongoose', 5, 7)], 4, 6],
            [[new Item('Elixir of the Mongoose', -5, 7)], -6, 5],
            [[new Item('Elixir of the Mongoose', 5, 80)], 4, 50],
            [[new Item('Sulfuras, Hand of Ragnaros', 2, 80)], 2, 80],
            [[new Item('Sulfuras, Hand of Ragnaros', -2, 80)], -2, 80],
            [[new Item('Sulfuras, Hand of Ragnaros', 2, 20)], 2, 80],
            [[new Item('Sulfuras, Hand of Ragnaros', -2, 20)], -2, 80],
            [[new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20)], 14, 21],
            [[new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20)], -1, 0],
            [[new Item('Backstage passes to a TAFKAL80ETC concert', -10, 50)], -11, 0],
            [[new Item('Backstage passes to a TAFKAL80ETC concert', -10, 150)], -11, 0],
            [[new Item('Backstage passes to a TAFKAL80ETC concert', 10, 48)], 9, 50],
            [[new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49)], 9, 50],
            [[new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49)], 4, 50],
            [[new Item('Backstage passes to a TAFKAL80ETC concert', 5, 47)], 4, 50],
            [[new Item('Conjured', 5, 47)], 4, 45],
            [[new Item('Conjured', 5, 80)], 4, 50],
            [[new Item('Conjured', -5, 10)], -6, 6],
        ];
    }

    /**
     * @dataProvider updateQualityDataProvider
     * @param Item[] $items
     * @param int $expectedSellIn
     * @param int $expectedQuality
     */
    public function testUpdateQuality(
        array $items,
        int $expectedSellIn,
        int $expectedQuality
    ): void {
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($expectedQuality, $gildedRose->getItems()[0]->getQuality());
        $this->assertSame($expectedSellIn, $gildedRose->getItems()[0]->getSellIn());
    }
}
