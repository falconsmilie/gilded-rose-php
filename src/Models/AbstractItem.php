<?php

declare(strict_types=1);

namespace GildedRose\Models;

class AbstractItem
{
    protected const MAX_QUALITY = 50;

    public string $name;
    public int $quality;
    public int $sellIn;

    public function __construct(string $name, int $quality, int $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public function getName(): string
    {
        return $this->name;
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
