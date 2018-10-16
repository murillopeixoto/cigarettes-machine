<?php

namespace App\Machine;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class CigaretteFactory
{
    /**
     * @param int $itemCount
     * @param float $amount
     * @return PurchaseTransactionInterface
     */
    public static function createCigarettePurchaseTransaction(
        int $itemCount,
        float $amount
    ): PurchaseTransactionInterface {
        return new CigarettePurchaseTransaction($itemCount, $amount);
    }

    /**
     * @return MachineInterface
     */
    public static function createCigarreteMachine(): MachineInterface
    {
        return new CigaretteMachine();
    }

    /**
     * @param OutputInterface $output
     * @return PrinterInterface
     */
    public static function createPrinter(OutputInterface $output): PrinterInterface
    {
        return new Printer($output, new Table($output));
    }
}
