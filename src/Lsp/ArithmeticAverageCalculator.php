<?php

namespace Src\Lsp;

class ArithmeticAverageCalculator implements AverageCalculator
{
    public static function calculate(array $grades): float
    {
        if (empty($grades)) { return 0; }
        $sum = 0;
        foreach ($grades as $grade) {
            $sum += $grade->value;
        }
        return $sum / count($grades);
    }
}
