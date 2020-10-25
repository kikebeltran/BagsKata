<?php

declare(strict_types = 1);

namespace BagsKata\Tests\Domain;
use PHPUnit\Framework\TestCase;

use BagsKata\App\Domain\Backpack;
use BagsKata\App\Domain\Item;
use BagsKata\App\Domain\ItemCategory;
use BagsKata\App\Exceptions\BackpackFullException;

class BackpackTest extends TestCase
{

    /** @test */
    public function it_should_return_a_new_empty_backpack(): void
    {

        $backpack = new Backpack();
        $this->assertEquals([], $backpack->items());

    }

    /** @test */
    public function it_should_add_an_item_to_bag(): void
    {
        
        $leather = new Item('Leather');
        $backpack = new Backpack();

        $backpack->add($leather);

        $this->assertEquals([$leather], $backpack->items());
    } 

    /** @test */
    public function it_should_throw_a_full_backpack_exception(): void
    {

        $backpack = new Backpack();

        $backpack->add(new Item('Leather'));
        $backpack->add(new Item('Linen'));
        $backpack->add(new Item('Silk'));
        $backpack->add(new Item('Wool'));
        $backpack->add(new Item('Copper'));
        $backpack->add(new Item('Gold'));
        $backpack->add(new Item('Iron'));
        $backpack->add(new Item('Silver'));
        
        $this->expectException(BackpackFullException::class);

        $backpack->add(new Item('Iron'));

    } 


}