<?php

declare(strict_types = 1);

namespace BagsKata\App\Domain;

use BagsKata\App\Exceptions\BackpackFullException;

class Backpack
{
    
    const MAX_ITEMS = 8;

    /**
     * @var Item[]
    */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function items(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function add(Item $item): void
    {
        if (count($this->items) >= self::MAX_ITEMS)
            throw new BackpackFullException('Backpack is full');


        $this->items[] = $item;
    }
    
}