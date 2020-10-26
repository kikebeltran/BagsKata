<?php

declare(strict_types = 1);

namespace BagsKata\App\Domain;

use BagsKata\App\Exceptions\BagFullException;
use BagsKata\App\Exceptions\AllBagsFullException;
use BagsKata\App\Exceptions\UserBagsMaxException;

class User
{

    const MAX_BAGS = 4;

    private Backpack $backpack;
    /**
     * @var Bag
     */
    private array $bags;


    public function __construct()
    {
        $this->backpack = new Backpack();
        $this->bags = [];
    }

    public function backpack(): Backpack
    {
        return $this->backpack;
    }

    public function bags(): array
    {
        return $this->bags;
    }

    public function pickUpItem(Item $item): void
    {

        if(count($this->backpack->items()) >= Backpack::MAX_ITEMS)
            $this->storeItemAtFollowAvailableBag($item);
        else 
            $this->backpack->add($item);

    }
    
    public function addBag(Bag $bag): void
    {

        if (count($this->bags) >= self::MAX_BAGS)
            throw new UserBagsMaxException('You can not have more than 4 bags');
        
        $this->bags[] = $bag;

    }

    public function storeItemAtFollowAvailableBag(Item $item): void
    {

        foreach($this->bags as $bag){
            try {
                $bag->add($item);
                return;
            } catch (BagFullException $e) {}
        }

        throw new AllBagsFullException('You can not store more items');
        
    }

    public function setBackpack(Backpack $backpack): void
    {
        $this->backpack = $backpack;
    }

    
}