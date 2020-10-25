<?php

declare(strict_types = 1);

namespace BagsKata\App\Domain;

use BagsKata\App\Exceptions\BagFullException;

class Bag
{

    const QUANTITY = 4;

    private array $items;

    public function __construct(string $category = null)
    {
        $this->category = $category;
        $this->items = [];
    }

    public function category(): ?string
    {
        return $this->category;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function add(Item $item): void
    {
        if (count($this->items) >= self::QUANTITY) {
            throw new BagFullException('Bag is full');
        }

        $this->items[] = $item;
    }
    
}