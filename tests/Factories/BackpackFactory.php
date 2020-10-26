<?php

declare(strict_types = 1);

namespace BagsKata\Tests\Factories;

use BagsKata\App\Domain\Item;
use BagsKata\App\Domain\Backpack;


class BackpackFactory
{

    public function  __construct() {}

    public function fillBackpack(): Backpack
    {
        $backpack = new Backpack();
        $backpack->add(new Item('Leather'));
        $backpack->add(new Item('Leather'));
        $backpack->add(new Item('Leather'));
        $backpack->add(new Item('Leather'));
        $backpack->add(new Item('Leather'));
        $backpack->add(new Item('Leather'));
        $backpack->add(new Item('Leather'));
        $backpack->add(new Item('Leather'));

        return $backpack;
    }

    public function fillBackpackRandomItems(): Backpack
    {
        $backpack = new Backpack();
        $backpack->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $backpack->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $backpack->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $backpack->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $backpack->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $backpack->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $backpack->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $backpack->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);

        return $backpack;

    }

    
}