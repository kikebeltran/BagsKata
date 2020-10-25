<?php

declare(strict_types = 1);

namespace BagsKata\App\Domain;

use BagsKata\App\Exceptions\InvalidItemNameException;


class Item
{
    
    const VALID_ITEMS = [
        ['name' => 'Leather', 'category' => 'Clothes'],
        ['name' => 'Linen', 'category' => 'Clothes'],
        ['name' => 'Silk', 'category' => 'Clothes'],
        ['name' => 'Wool', 'category' => 'Clothes'],
        ['name' => 'Copper', 'category' => 'Metals'],
        ['name' => 'Gold', 'category' => 'Metals'],
        ['name' => 'Iron', 'category' => 'Metals'],
        ['name' => 'Silver', 'category' => 'Metals'],
        ['name' => 'Axe', 'category' => 'Weapons'],
        ['name' => 'Dagger', 'category' => 'Weapons'],
        ['name' => 'Mace', 'category' => 'Weapons'],
        ['name' => 'Sword', 'category' => 'Weapons'],
        ['name' => 'Cherry Blossom'   , 'category' => 'Herbs'],
        ['name' => 'Marigold', 'category' => 'Herbs'],
        ['name' => 'Rose', 'category' => 'Herbs'],
        ['name' => 'Seaweed', 'category' => 'Herbs']
    ];

    public string $name;
    public string $category;

    public function __construct(string $name)
    {
        $this->name = $name;
        $arrayposition = array_search($name, array_column(Item::VALID_ITEMS, 'name'));

        if($arrayposition === false)
            throw new InvalidItemNameException('This item could not be recognized');

        $this->category = self::VALID_ITEMS[$arrayposition]['category'];
        
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): string
    {
        return $this->category;
    }
    
}
