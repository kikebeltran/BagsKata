<?php

declare(strict_types = 1);

namespace BagsKata\Tests\Domain;

use BagsKata\App\Domain\Bag;
use BagsKata\App\Domain\Item;
use BagsKata\App\Domain\User;
use PHPUnit\Framework\TestCase;
use BagsKata\App\UseCase\OrganizingSpell;


class OrganizingSpellTest extends TestCase
{

    private OrganizingSpell $spell;
    private User $durance;

    public function setUp(): void
    {
        parent::setUp();
        $this->spell = new OrganizingSpell();
    }


    /** @test */
    public function it_should_simulate_example(): void
    {

        $durance = new User();

        $leather = new Item('Leather');
        $iron = new Item('Iron');
        $copper = new Item('Copper');
        $marigold = new Item('Marigold');
        $wool = new Item('Wool');
        $gold = new Item('Gold');
        $silk = new Item('Silk');
        $copper_2 = new Item('Copper');
        $copper_3 = new Item('Copper');
        $cherryBlossom = new Item('Cherry Blossom');

        $metalsBag = new Bag('Metals');

        $durance->addBag($metalsBag);

        $durance->pickUpItem($leather);        
        $durance->pickUpItem($iron);
        $durance->pickUpItem($copper);
        $durance->pickUpItem($marigold);
        $durance->pickUpItem($wool);
        $durance->pickUpItem($gold);
        $durance->pickUpItem($silk);
        $durance->pickUpItem($copper_2);        
        $durance->pickUpItem($copper_3);
        $durance->pickUpItem($cherryBlossom);

        $this->spell->spell($durance);

        $this->assertEquals(
            [
                $cherryBlossom, 
                $iron, 
                $leather, 
                $marigold, 
                $silk, 
                $wool
            ], 
            $durance->backpack()->items()
        );
        $this->assertEquals(
            [
                $copper,
                $copper_2,
                $copper_3,
                $gold
            ], 
            $metalsBag->items()
        );
    }
 

    /** @test */
    public function it_should_categorize_items_on_proper_bag_and_backpack(): void
    {
        $weaponsBag = new Bag('Weapons');
        $metalsBag = new Bag('Metals');

        $iron = new Item('Iron');
        $copper = new Item('Copper');
        $leather = new Item('Leather');

        $durance = new User();

        $durance->addBag($weaponsBag);
        $durance->addBag($metalsBag);

        $durance->pickUpItem($iron);
        $durance->pickUpItem($leather);
        $durance->pickUpItem($copper);

        $this->spell->spell($durance);

        $this->assertEquals([$leather], $durance->backpack()->items());
        $this->assertEmpty($weaponsBag->items());
        // Important compare with alphabetical order
        $this->assertEquals([$copper, $iron], $metalsBag->items());

    }


    /** @test */
    public function it_should_categorize_items_on_proper_bag_and_backpack_will_be_empty(): void
    {
        $weaponsBag = new Bag('Weapons');
        $metalsBag = new Bag('Metals');


        $copper = new Item('Copper');
        $gold = new Item('Gold');
        $iron = new Item('Iron');
        $silver = new Item('Silver');
        $axe = new Item('Axe');
        $dagger = new Item('Dagger');
        $mace = new Item('Mace');
        $sword = new Item('Sword');

        $durance = new User();

        $durance->addBag($weaponsBag);
        $durance->addBag($metalsBag);
  
        
        $durance->pickUpItem($dagger);
        $durance->pickUpItem($iron);
        $durance->pickUpItem($sword);
        $durance->pickUpItem($axe);
        $durance->pickUpItem($silver);
        $durance->pickUpItem($mace);
        $durance->pickUpItem($gold);
        $durance->pickUpItem($copper);
        

        $this->spell->spell($durance);

        $this->assertEmpty($durance->backpack()->items());
        $this->assertEquals(
            [
                $copper,
                $gold,
                $iron,
                $silver
            ], 
            $metalsBag->items() 
        );
        $this->assertEquals(
            [
                $axe,
                $dagger,
                $mace,
                $sword
            ], 
            $weaponsBag->items()
        );

    }
    

    /** @test */
    public function it_should_store_items_at_backpack_and_bags_will_be_empty(): void
    {

        $weaponsBag = new Bag();
        $metalsBag = new Bag();

        $copper = new Item('Copper');
        $gold = new Item('Gold');
        $iron = new Item('Iron');
        $silver = new Item('Silver');
        $axe = new Item('Axe');
        $dagger = new Item('Dagger');
        $mace = new Item('Mace');
        $sword = new Item('Sword');

        $durance = new User();

        $durance->addBag($weaponsBag);
        $durance->addBag($metalsBag);
        
        $durance->pickUpItem($dagger);
        $durance->pickUpItem($iron);
        $durance->pickUpItem($sword);
        $durance->pickUpItem($axe);
        $durance->pickUpItem($silver);
        $durance->pickUpItem($mace);
        $durance->pickUpItem($gold);
        $durance->pickUpItem($copper);

        $this->spell->spell($durance);

        $this->assertEquals(
            [
                $axe,
                $copper,
                $dagger,
                $gold,
                $iron,
                $mace,
                $silver,
                $sword
            ],
            $durance->backpack()->items()
        );
        $this->assertEmpty(
            $metalsBag->items() 
        );
        $this->assertEmpty(
            $weaponsBag->items()
        );
  
      }

}