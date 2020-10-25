<?php

declare(strict_types = 1);

namespace BagsKata\App\Domain;

use BagsKata\App\Exceptions\BackpackFullException;

class Backpack
{
    
    const QUANTITY = 8;

    /**
     * @var string
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

    public function add(Item $item): void
    {
        if (count($this->items) >= self::QUANTITY) {
            throw new BackpackFullException('Backpack is full');
        }

        $this->items[] = $item;
    }
    
}