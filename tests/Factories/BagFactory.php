<?php

declare(strict_types = 1);

namespace BagsKata\Tests\Factories;

use BagsKata\App\Domain\Bag;
use BagsKata\App\Domain\Item;


class BagFactory
{

    public function  __construct() {}

    public function fillBag(): Bag
    {

        $bag = new Bag();
        $bag->add(new Item('Leather'));
        $bag->add(new Item('Leather'));
        $bag->add(new Item('Leather'));
        $bag->add(new Item('Leather'));

        return $bag;
        
    }
    
    public function fillBagRandomItems(): Bag
    {

        $bag = new Bag();
        $bag->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $bag->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $bag->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);
        $bag->add(Item::VALID_ITEMS[rand(0,count(Item::VALID_ITEMS)-1)]);

        return $bag;
        
    }
    
}