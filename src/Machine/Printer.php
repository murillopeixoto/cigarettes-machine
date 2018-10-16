<?php

namespace App\Machine;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class Printer implements PrinterInterface
{
    /**
     * @var OutputInterface
     */
    private $outPut;

    /**
     * @var Table
     */
    private $table;

    const SUCCESS = 'You bought <info>%d</info> packs of cigarettes for <info>%.2f</info>, each for <info>%.2f</info>.';

    const FAILURE = 'You tried to buy <info>%d</info> packs but you paid <info>%.2f</info>, you have to pay more <info>%.2f</info>.';

    /**
     * Printer constructor.
     * @param OutputInterface $output
     * @param Table $table
     */
    public function __construct(OutputInterface $output, Table $table)
    {
        $this->outPut = $output;
        $this->table = $table;
    }

    /**
     * @param PurchasedItemInterface $purchasedItem
     */
    public function printSuccessMessage(PurchasedItemInterface $purchasedItem): void
    {
        $this->outPut->writeln(sprintf(
            self::SUCCESS,
            $purchasedItem->getItemQuantity(),
            $purchasedItem->getTotalAmount(),
            CigarettePurchasedItem::ITEM_PRICE
        ));

        $this->outPut->writeln('Your change is:');

        $this->table->setHeaders(['Coins', 'Count']);
        $this->table->setRows($purchasedItem->getChange());
        $this->table->render();
    }

    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     * @param float $amountMissing
     */
    public function printFailureMessage(
        PurchaseTransactionInterface $purchaseTransaction,
        float $amountMissing
    ): void {
        $this->outPut->writeln(sprintf(
            self::FAILURE,
            $purchaseTransaction->getItemQuantity(),
            $purchaseTransaction->getPaidAmount(),
            $amountMissing
        ));
    }
}
