<?php

declare(strict_types=1);

namespace GildedRose\Factories;

use GildedRose\Item;
use GildedRose\Models\Products\AbstractItem;
use GildedRose\Models\Products\AgedBrie;
use GildedRose\Models\Products\BackStagePass;
use GildedRose\Models\Products\Conjured;
use GildedRose\Models\Products\StandardItem;
use GildedRose\Models\Products\Sulfuras;
use InvalidArgumentException;

class ItemFactory
{
    public const ELIXIR_OF_MONGOOSE = 'Elixir of the Mongoose';
    public const PLUS_5_DEXTERITY_VEST = '+5 Dexterity Vest';
    public const AGED_BRIE = 'Aged Brie';
    public const BACKSTAGE_PASS = 'Backstage passes to a TAFKAL80ETC concert';
    public const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    public const CONJURED_MANA_CAKE = 'Conjured Mana Cake';

    /**
     * @param Item $item
     * @return AbstractItem
     * @throws InvalidArgumentException
     */
    public static function create(Item $item): AbstractItem
    {
        switch ($item->name) {
            case self::ELIXIR_OF_MONGOOSE:
            case self::PLUS_5_DEXTERITY_VEST:
                return new StandardItem($item);

            case self::AGED_BRIE:
                return new AgedBrie($item);

            case self::BACKSTAGE_PASS:
                return new BackStagePass($item);

            case self::SULFURAS:
                return new Sulfuras($item);

            case (str_contains($item->name, 'Conjured')):
                return new Conjured($item);

            default:
                throw new InvalidArgumentException('Unknown Item: ' . $item->name);
        }
    }
}
