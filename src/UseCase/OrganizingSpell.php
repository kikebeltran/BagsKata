<?php

declare(strict_types = 1);

namespace BagsKata\App\UseCase;

use BagsKata\App\Domain\Backpack;
use BagsKata\App\Domain\Bag;
use BagsKata\App\Domain\Item;
use BagsKata\App\Domain\User;

class OrganizingSpell
{

    /**
     * @var Item[]
     */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function spell(User $user): void
    {

        $this->clearBackpack($user->backpack());
        $this->clearBags($user->bags());
        $this->sortItems();
        $this->putItemsAtProperlyBag($user);
        $this->putRemainingItemsAtProperPlace($user);

    }

    public function clearBackpack(Backpack $backpack):void
    {
        $this->clearItems($backpack->items());
        $backpack->setItems([]);
   
    }

    public function clearBags($bags): void
    {
        foreach ($bags as $bag) {
            $this->clearBag($bag);
        }
    }

    public function clearBag(Bag $bag):void
    {
        $this->clearItems($bag->items());
        $bag->setItems([]);
    }

    public function clearItems(array $items): void
    {
        foreach ($items as $item) {
            $this->items[] = $item;
        }
    }

    public function sortItems(): void
    {
        usort($this->items, function ($item1, $item2) {
            return $item1->name() <=> $item2->name();
        });
    }

    public function putItemsAtProperlyBag(User $user): void
    {
        
        foreach ($user->bags() as $bag) {
            $bag->setItems($this->fillBagsByCategory($bag->category()));
        }

    }
    
    public function fillBagsByCategory(?string $category): array
    {

        $categoryItems = [];
        $remainingItems = [];

        foreach($this->items as $item){
      
            if (
                ($item->category() === $category) && 
                count($categoryItems) <= Bag::MAX_ITEMS-1
            ) {
                $categoryItems[] = $item;
            } else {
                $remainingItems[] = $item;
            }
        }

        $this->items = $remainingItems;

        return $categoryItems;

    }

    private function putRemainingItemsAtProperPlace(User $user): void
    {
        foreach ($this->items as $item) {
            $user->pickUpItem($item);
        }
    }
    
}