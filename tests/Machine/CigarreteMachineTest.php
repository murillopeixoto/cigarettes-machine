<?php

namespace App\Machine;

use PHPUnit\Framework\TestCase;

class CigarreteMachineTest extends TestCase
{
    public function testExecuteWithCorrectValueReturnsPurchasedItem()
    {
        $purchasedTransaction = new CigarettePurchaseTransaction(1, 5);
        $machine = new CigaretteMachine();
        $purchasedItem = $machine->execute($purchasedTransaction);
        $this->assertInstanceOf(PurchasedItemInterface::class, $purchasedItem);
    }

    /**
     * @expectedException App\Machine\AmountNotEnoughException
     */
    public function testExecuteWithAmountLowerThanTotalPriceThrowsAmountNotEnoughException()
    {
        $purchasedTransaction = new CigarettePurchaseTransaction(1, 4);
        $machine = new CigaretteMachine();
        $machine->execute($purchasedTransaction);
    }
}
