<?php

declare(strict_types=1);

namespace Tests\Factories;

use GildedRose\Factories\ItemFactory;
use GildedRose\Item;
use GildedRose\Models\Products\AgedBrie;
use GildedRose\Models\Products\BackStagePass;
use GildedRose\Models\Products\Conjured;
use GildedRose\Models\Products\StandardItem;
use GildedRose\Models\Products\Sulfuras;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ItemFactoryTest extends TestCase
{
    public function createItemDataProvider(): array
    {
        return [
            [new Item(ItemFactory::ELIXIR_OF_MONGOOSE, 1, 1), StandardItem::class],
            [new Item(ItemFactory::PLUS_5_DEXTERITY_VEST, 1, 1), StandardItem::class],
            [new Item(ItemFactory::AGED_BRIE, 1, 1), AgedBrie::class],
            [new Item(ItemFactory::BACKSTAGE_PASS, 1, 1), BackStagePass::class],
            [new Item(ItemFactory::SULFURAS, 1, 1), Sulfuras::class],
            [new Item(ItemFactory::CONJURED_MANA_CAKE, 1, 1), Conjured::class],
        ];
    }

    /**
     * @dataProvider createItemDataProvider
     * @param Item $item
     * @param string $expectedInstance
     */
    public function testCreateItem(Item $item, string $expectedInstance): void
    {
        $this->assertInstanceOf($expectedInstance, ItemFactory::create($item));
    }

    public function testCreateInvalidItem(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ItemFactory::create(new Item('RealLy BaD nAme', 1, 1));
    }
}
