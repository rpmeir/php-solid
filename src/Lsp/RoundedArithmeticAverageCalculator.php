<?php

namespace Src\Lsp;

class RoundedArithmeticAverageCalculator implements AverageCalculator
{
    public static function calculate(array $grades): float
    {
        if (empty($grades)) { return 0; }
        $sum = 0;
        foreach ($grades as $grade) {
            $sum += $grade->value;
        }
        $average = round($sum / count($grades));
        return ($average >= 5.75 && $average <= 6.0) ? 6.0 : $average;
    }
}
