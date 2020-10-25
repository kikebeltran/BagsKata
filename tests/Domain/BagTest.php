<?php

declare(strict_types = 1);

namespace BagsKata\Tests\Domain;

use BagsKata\App\Domain\Bag;
use BagsKata\App\Domain\Item;
use BagsKata\App\Exceptions\BagFullException;
use PHPUnit\Framework\TestCase;


class BagTest extends TestCase
{

    /** @test */
    public function it_should_return_a_new_empty_bag(): void
    {

        $bag = new Bag();
        $this->assertEquals([], $bag->items());

    }

    /** @test */
    public function it_should_add_an_item_to_bag(): void
    {
        
        $leather = new Item('Leather');
        $bag = new Bag();

        $bag->add($leather);

        $this->assertEquals([$leather], $bag->items());
    } 

    /** @test */
    public function it_should_create_a_bag_without_category(): void
    {
        
        $bag = new Bag();

        $this->assertEquals($bag->category(), null);
    } 
    

    /** @test */
    public function it_should_add_an_item_and_category_to_bag(): void
    {
        
        $leather = new Item('Leather');
        $bag = new Bag($leather->category);
        $bag->add($leather);

        $this->assertEquals($bag->category(), 'Clothes');

    } 

    // /** @test */
    public function it_should_throw_a_full_bag_exception(): void
    {

        $bag = new Bag();

        $bag->add(new Item('Leather'));
        $bag->add(new Item('Linen'));
        $bag->add(new Item('Silk'));
        $bag->add(new Item('Wool'));
        
        $this->expectException(BagFullException::class);

        $bag->add(new Item('Wool'));

    } 
    


}