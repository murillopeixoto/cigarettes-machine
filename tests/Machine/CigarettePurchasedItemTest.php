<?php

namespace App\Machine;

use PHPUnit\Framework\TestCase;

class CigarettePurchasedItemTest extends TestCase
{
    public function testPurchasedItemObject()
    {
        $itemCount = 1;
        $amount = 1.00;
        $purchaseTransaction = new CigarettePurchaseTransaction($itemCount, $amount);
        $purchasedItem = new CigarettePurchasedItem($purchaseTransaction);
        $this->assertEquals(1, $purchasedItem->getItemQuantity());
        $this->assertEquals(4.99, $purchasedItem->getTotalAmount());
        $this->assertEquals([], $purchasedItem->getChange());
        $this->assertEquals(3.99, $purchasedItem->getAmountMissing());
        $this->assertEquals(true, $purchasedItem->isSomeAmountMissing());
    }

    public function testWithAmountSmallerThanTotalAmountGetAmountMissingHasTheDifferenceAndIsSomeAmountMissingIsTrue()
    {
        $itemCount = 3;
        $amount = 10.00;
        $purchaseTransaction = new CigarettePurchaseTransaction($itemCount, $amount);
        $purchasedItem = new CigarettePurchasedItem($purchaseTransaction);
        $this->assertEquals(3, $purchasedItem->getItemQuantity());
        $this->assertEquals(14.97, $purchasedItem->getTotalAmount());
        $this->assertEquals([], $purchasedItem->getChange());
        $this->assertEquals(4.97, $purchasedItem->getAmountMissing());
        $this->assertEquals(true, $purchasedItem->isSomeAmountMissing());
    }

    public function testWithAmountBiggerThanTotalAmountGetAmountMissingIsZeroAndIsSomeAmountMissingIsFalse()
    {
        $itemCount = 5;
        $amount = 25.00;
        $purchaseTransaction = new CigarettePurchaseTransaction($itemCount, $amount);
        $purchasedItem = new CigarettePurchasedItem($purchaseTransaction);
        $this->assertEquals(5, $purchasedItem->getItemQuantity());
        $this->assertEquals(24.95, $purchasedItem->getTotalAmount());
        $this->assertEquals([['0.02', 2]], $purchasedItem->getChange());
        $this->assertEquals(0, $purchasedItem->getAmountMissing());
        $this->assertEquals(false, $purchasedItem->isSomeAmountMissing());
    }
}
