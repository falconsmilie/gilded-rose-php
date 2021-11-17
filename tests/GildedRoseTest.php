<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Factories\ItemFactory;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function updateQualityDataProvider(): array
    {
        // $type, $item, $expectedSellIn, $expectedQuality
        return [
            [[new Item(ItemFactory::PLUS_5_DEXTERITY_VEST, 10, 20)], 9, 19],
            [[new Item(ItemFactory::PLUS_5_DEXTERITY_VEST, 0, 20)], -1, 18],
            [[new Item(ItemFactory::AGED_BRIE, 2, 2)], 1, 3],
            [[new Item(ItemFactory::AGED_BRIE, -2, 2)], -3, 4],
            [[new Item(ItemFactory::ELIXIR_OF_MONGOOSE, 5, 7)], 4, 6],
            [[new Item(ItemFactory::ELIXIR_OF_MONGOOSE, -5, 7)], -6, 5],
            [[new Item(ItemFactory::ELIXIR_OF_MONGOOSE, 5, 80)], 4, 50],
            [[new Item(ItemFactory::SULFURAS, 2, 80)], 100, 80],
            [[new Item(ItemFactory::SULFURAS, -2, 80)], 100, 80],
            [[new Item(ItemFactory::SULFURAS, 2, 20)], 100, 80],
            [[new Item(ItemFactory::SULFURAS, -2, 20)], 100, 80],
            [[new Item(ItemFactory::BACKSTAGE_PASS, 15, 20)], 14, 21],
            [[new Item(ItemFactory::BACKSTAGE_PASS, 0, 20)], -1, 0],
            [[new Item(ItemFactory::BACKSTAGE_PASS, -10, 50)], -11, 0],
            [[new Item(ItemFactory::BACKSTAGE_PASS, -10, 150)], -11, 0],
            [[new Item(ItemFactory::BACKSTAGE_PASS, 10, 48)], 9, 50],
            [[new Item(ItemFactory::BACKSTAGE_PASS, 10, 49)], 9, 50],
            [[new Item(ItemFactory::BACKSTAGE_PASS, 5, 49)], 4, 50],
            [[new Item(ItemFactory::BACKSTAGE_PASS, 5, 47)], 4, 50],
            [[new Item(ItemFactory::CONJURED_MANA_CAKE, 5, 47)], 4, 45],
            [[new Item(ItemFactory::CONJURED_MANA_CAKE, 5, 80)], 4, 50],
            [[new Item(ItemFactory::CONJURED_MANA_CAKE, -5, 10)], -6, 6],
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
