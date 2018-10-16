<?php

namespace App\Command;

use App\Machine\AmountNotEnoughException;
use App\Machine\CigaretteFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface   $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $itemCount = (int) $input->getArgument('packs');
        $amount = (float) \str_replace(',', '.', $input->getArgument('amount'));

        $purchaseTransaction = CigaretteFactory::createCigarettePurchaseTransaction($itemCount, $amount);
        $cigaretteMachine = CigaretteFactory::createCigarreteMachine();
        $printer = CigaretteFactory::createPrinter($output);

        try {
            $purchaseItem = $cigaretteMachine->execute($purchaseTransaction);
            $printer->printSuccessMessage($purchaseItem, $purchaseTransaction);
        } catch (AmountNotEnoughException $e) {
            $printer->printFailureMessage($purchaseTransaction, $e->getAmount());
        }
    }
}
