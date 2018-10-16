<?php

namespace App\Machine;

class ChangeCalculator
{
    /**
     * @var array
     */
    static private $availableCash = [
        500.00,
        200.00,
        100.00,
        50.00,
        20.00,
        10.00,
        5.00,
        2.00,
        1.00,
        0.50,
        0.20,
        0.10,
        0.05,
        0.02,
        0.01,
    ];

    /**
     * @param float $totalExpected
     * @return array
     */
    public static function calculate(float $totalExpected): array
    {
        $totalMissing = $totalExpected;
        /** @todo Implement a collection */
        $totalInCash = [];
        foreach (self::$availableCash as $cash) {
            $count = self::calculateCash($totalMissing, $cash);
            if ($count > 0) {
                /** @todo Implement an entity */
                $totalInCash[] = [sprintf('%.2f', $cash), $count];
                $totalMissing -= $cash * $count;
            }
        }

        return $totalInCash;
    }

    /**
     * @param float $totalMissing
     * @param float $cash
     * @return int
     */
    private static function calculateCash(float $totalMissing, float $cash): int
    {
        if ($totalMissing < $cash) {
            return 0;
        }

        return self::calculateCash($totalMissing - $cash, $cash) + 1;
    }
}
