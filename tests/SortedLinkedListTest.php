<?php

declare(strict_types=1);

set_time_limit(1);

use App\SortedLinkedList;
use PHPUnit\Framework\TestCase;

class SortedLinkedListTest extends TestCase
{
    public function testInsertAndCompareSortedArray(): void
    {
        $list = new SortedLinkedList();
        $list->add(9);
        $list->add(2);
        $list->add(7);

        $this->assertEquals([2, 7, 9], $list->toArray());
    }

    public function testRemoveAndCompareSortedArray(): void
    {
        $list = new SortedLinkedList();
        $list->add(5);
        $list->add(4);
        $list->add(6);

        $this->assertTrue($list->remove(5));
        $this->assertFalse($list->remove(11));

        $this->assertEquals([4, 6], $list->toArray());
    }

    public function testRemoveDifferentDataType(): void
    {
        $list = new SortedLinkedList();
        $list->add('train');
        $list->add('car');

        $this->assertTrue($list->remove('car'));
        $this->assertFalse($list->remove(5));
    }

    public function testListNodesCount(): void
    {
        $list = new SortedLinkedList();
        $list->add(7);
        $list->add(6);
        $list->add(5);

        $this->assertEquals(3, $list->getSize());
    }

    public function testValueContainsInList(): void
    {
        $list = new SortedLinkedList();
        $list->add('bike');
        $list->add('vehicle');

        $this->assertTrue($list->contains('bike'));
        $this->assertFalse($list->contains('jet'));
    }

    public function testWrongDataTypeError(): void
    {
        $this->expectException(TypeError::class);

        $list = new SortedLinkedList();
        $list->add(7.89);
    }

    public function testMixedDataTypesThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $list = new SortedLinkedList();
        $list->add('motorbike');
        $list->add(7);
    }
}
