<?php

declare(strict_types = 1);

namespace BagsKata\Tests\Domain;

use BagsKata\App\Domain\Bag;
use BagsKata\App\Domain\Item;
use BagsKata\App\Domain\User;
use BagsKata\App\Exceptions\AllBagsFullException;
use PHPUnit\Framework\TestCase;
use BagsKata\App\Exceptions\UserBagsMaxException;
use BagsKata\Tests\Factories\BackpackFactory;
use BagsKata\Tests\Factories\BagFactory;

class UserTest extends TestCase
{

    /** @test */
    public function it_should_create_a_user(): void
    {

        $durance = new User();

        $this->assertInstanceOf(User::class, $durance);
        $this->assertEmpty($durance->backpack()->items());
        $this->assertEquals([], $durance->bags());
        $this->assertEquals(0, count($durance->bags()));
        
    }

    /** @test */
    public function it_should_create_a_user_and_add_one_bag(): void
    {

        $durance = new User();
        $bag = new Bag();
        $durance->addBag($bag);

        $this->assertEquals([$bag], $durance->bags());
        $this->assertEquals(1, count($durance->bags()));

    }
    
    /** @test */
    public function it_should_create_a_user_and_add_4_bags(): void
    {

        $durance = new User();

        $bag_1 = new Bag();
        $bag_2 = new Bag();
        $bag_3 = new Bag();
        $bag_4 = new Bag();

        $durance->addBag($bag_1);
        $durance->addBag($bag_2);
        $durance->addBag($bag_3);
        $durance->addBag($bag_4);

        $this->assertEquals([$bag_1, $bag_2, $bag_3, $bag_4], $durance->bags());
        $this->assertEquals(4, count($durance->bags()));

    }

    
    /** @test */
    public function it_should_throw_an_max_bags_exception(): void
    {

        $this->expectException(UserBagsMaxException::class);

        $durance = new User();

        $bag_1 = new Bag();
        $bag_2 = new Bag();
        $bag_3 = new Bag();
        $bag_4 = new Bag();
        $bag_5 = new Bag();

        $durance->addBag($bag_1);
        $durance->addBag($bag_2);
        $durance->addBag($bag_3);
        $durance->addBag($bag_4);
        $durance->addBag($bag_5);

    }

    
   /** @test */
   public function it_should_add_some_pick_up_items_to_backpack(): void
   {

       $durance = new User();

       $leather = new Item('Leather');
       $durance->pickUpItem($leather);

       $this->assertEquals([$leather], $durance->backpack()->items());
       $this->assertEquals(1, count($durance->backpack()->items()));
       
   }

   
   /** @test */
   public function it_should_fill_backpack(): void
   {

        $backpackFactory = new BackpackFactory();
        $durance = new User();
        $durance->setBackpack($backpackFactory->fillBackpack());

        $this->assertEquals(8, count($durance->backpack()->items()));
        
   }

   /** @test */
   public function it_should_create_a_bag_because_backpack_is_full(): void
   {

        $backpackFactory = new BackpackFactory();
        $durance = new User();
        $durance->setBackpack($backpackFactory->fillBackpack());

        $bag = new Bag();
        $wool = new Item('Wool');
        $durance->addBag($bag);

        $durance->pickUpItem($wool);

        $this->assertEquals(8, count($durance->backpack()->items()));
        $this->assertEquals(1, count($durance->bags()));
        $this->assertEquals([$wool], $bag->items());

   }
   
   /** @test */
   public function it_should_create_two_bags_because_backpack_and_first_bag_is_full(): void
   {

        $backpackFactory = new BackpackFactory();
        $bagFactory = new BagFactory();
        $durance = new User();

        $durance->setBackpack($backpackFactory->fillBackpack());
        $durance->addBag($bagFactory->fillBag());

        $wool = new Item('Wool');
        $bag_2 = new Bag();

        $durance->addBag($bag_2);
        $durance->pickUpItem($wool);

        $this->assertEquals(8, count($durance->backpack()->items()));
        $this->assertEquals(2, count($durance->bags()));
        $this->assertEquals([$wool], $bag_2->items());

   }

    /** @test */
    public function it_should_throw_an_exception_because_backpacks_and_bags_are_full(): void
    {

       $backpackFactory = new BackpackFactory();
       $bagFactory = new BagFactory();
       $durance = new User();
       
       $durance->setBackpack($backpackFactory->fillBackpack());
       $durance->addBag($bagFactory->fillBag());
       $durance->addBag($bagFactory->fillBag());
       $durance->addBag($bagFactory->fillBag());
       $durance->addBag($bagFactory->fillBag());
       
       $this->expectException(AllBagsFullException::class);

       $durance->pickUpItem(new Item('Wool'));
       
   }

   


}