<?php

namespace App\Machine;

/**
 * Interface CigaretteMachine
 * @package App\Machine
 */
interface MachineInterface
{
    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @throws AmountNotEnoughException
     * @return PurchasedItemInterface
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface;
}
