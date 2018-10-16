<?php

namespace App\Machine;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @throws AmountNotEnoughException
     * @return PurchasedItemInterface
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface
    {
        $cigarretePurchasedItem = new CigarettePurchasedItem($purchaseTransaction);
        if ($cigarretePurchasedItem->isSomeAmountMissing()) {
            throw new AmountNotEnoughException($cigarretePurchasedItem->getAmountMissing());
        }

        return $cigarretePurchasedItem;
    }
}
