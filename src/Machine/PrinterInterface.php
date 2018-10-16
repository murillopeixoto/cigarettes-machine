<?php

namespace App\Machine;

interface PrinterInterface
{
    /**
     * @param PurchasedItemInterface $purchasedItem
     */
    public function printSuccessMessage(PurchasedItemInterface $purchasedItem): void;

    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     * @param float $amountMissing
     */
    public function printFailureMessage(PurchaseTransactionInterface $purchaseTransaction, float $amountMissing): void;
}
