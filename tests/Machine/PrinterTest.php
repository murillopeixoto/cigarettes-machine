<?php

namespace App\Machine;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class PrinterTest extends TestCase
{
    /**
     * @var OutputInterface
     */
    private $outPut;

    /**
     * @var Table
     */
    private $table;

    public function setUp()
    {
        $this->outPut = $this->createMock(OutputInterface::class);
        $this->table = $this->createMock(Table::class);
    }

    public function testPrintSuccessMessageAssertMessageIsWrittenInOutPut()
    {
        $this->outPut
            ->expects($this->at(0))
            ->method('writeln')
            ->with('You bought <info>1</info> packs of cigarettes for <info>4.99</info>, each for <info>4.99</info>.');

        $printer = new Printer($this->outPut, $this->table);
        $purchasedTransaction = new CigarettePurchaseTransaction(1, 5);
        $purchasedItem = new CigarettePurchasedItem($purchasedTransaction);
        $printer->printSuccessMessage($purchasedItem);
    }

    public function testPrintFailureMessageAssertMessageIsWrittenInOutPut()
    {
        $this->outPut
            ->expects($this->once())
            ->method('writeln')
            ->with('You tried to buy <info>1</info> packs but you paid <info>1.00</info>, you have to pay more <info>3.99</info>.');

        $printer = new Printer($this->outPut, $this->table);
        $purchasedTransaction = new CigarettePurchaseTransaction(1, 1);
        $printer->printFailureMessage($purchasedTransaction, 3.99);
    }
}
