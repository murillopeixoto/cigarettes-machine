<?php

namespace App\Machine;

use PHPUnit\Framework\TestCase;

class ChangeCalculatorTest extends TestCase
{
    /**
     * @param float $totalChange
     * @param array $changeExpected
     *
     * @dataProvider provider
     */
    public function testChangeCalculator(float $totalChange, array $changeExpected)
    {
        $this->assertEquals($changeExpected, ChangeCalculator::calculate($totalChange));
    }

    /**
     * @return array
     */
    public function provider(): array
    {
        return [
            [11, [['10.00', 1], ['1.00', 1]]],
            [12, [['10.00', 1], ['2.00', 1]]],
            [17, [['10.00', 1], ['5.00', 1], ['2.00', 1]]],
            [9, [['5.00', 1], ['2.00', 2]]],
            [31.50, [['20.00', 1], ['10.00', 1], ['1.00', 1], ['0.50', 1]]],
            [99.98, [['50.00', 1], ['20.00', 2], ['5.00', 1], ['2.00', 2], ['0.50', 1], ['0.20', 2], ['0.05', 1], ['0.02', 2]]],
            [0.03, [['0.02', 1], ['0.01', 1]]]
        ];
    }
}
