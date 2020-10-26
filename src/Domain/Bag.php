<?php

declare(strict_types = 1);

namespace BagsKata\App\Domain;

use BagsKata\App\Exceptions\BagFullException;
use BagsKata\App\Exceptions\BagCategoryInvalidException;

class Bag
{

    const MAX_ITEMS = 4;

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

    public function setItems(array $items): void
    {
        $this->items = $items;
    }
    
    public function add(Item $item): void
    {
        if (count($this->items) >= self::MAX_ITEMS)
            throw new BagFullException('Bag is full');

        
        // if(!empty($this->category) && $this->category !== $item->category())            
        //     throw new BagCategoryInvalidException("This bag contains $this->category elements, we can not add elements from $item->category() category");


        $this->items[] = $item;
    }
    
}