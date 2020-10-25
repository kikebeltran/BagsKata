<?php

declare(strict_types = 1);

namespace BagsKata\Tests\Domain;

use BagsKata\App\Domain\Item;
use PHPUnit\Framework\TestCase;
use BagsKata\App\Exceptions\InvalidItemNameException;


class ItemTest extends TestCase
{



    /** @test */ 
    public function it_should_return_a_valid_item(): void
    {

        $item = new Item(Item::VALID_ITEMS[0]['name']);
        $this->assertInstanceOf(Item::class, $item);

    }

    /** @test */ 
    public function it_should_throw_an_exception_when_try_to_create_a_invalid_item(): void
    {

        $this->expectException(InvalidItemNameException::class);
        new Item('xxx');

    }





}