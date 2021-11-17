<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\Factories\ItemFactory;
use GildedRose\GildedRose;
use GildedRose\Item;

echo 'OMGHAI!' . PHP_EOL;

$items = [
    new Item(ItemFactory::PLUS_5_DEXTERITY_VEST, 10, 20),
    new Item(ItemFactory::AGED_BRIE, 2, 0),
    new Item(ItemFactory::ELIXIR_OF_MONGOOSE, 5, 7),
    new Item(ItemFactory::SULFURAS, 0, 80),
    new Item(ItemFactory::SULFURAS, -1, 80),
    new Item(ItemFactory::BACKSTAGE_PASS, 15, 20),
    new Item(ItemFactory::BACKSTAGE_PASS, 10, 49),
    new Item(ItemFactory::BACKSTAGE_PASS, 5, 49),
    new Item(ItemFactory::CONJURED_MANA_CAKE, 3, 6),
];

$app = new GildedRose($items);

$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo "-------- day $i --------" . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;

    foreach ($app->getItems() as $item) {
        echo $item . PHP_EOL;
    }

    echo PHP_EOL;

    $app->updateQuality();
}
