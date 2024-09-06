<?php

namespace Src\Lsp;

class AverageCalculatorTypeB implements AverageCalculator
{
    /**
     * Summary of calculate
     * @param array<Grade> $grades
     * @return float
     */
    public static function calculate(array $grades): float
    {
        if (empty($grades)) { return 0; }
        $sum = 0;
        foreach ($grades as $grade) {
            if ($grade->value > 10) { throw new InvalidGradeException("Invalid Grade", 1); }
            $sum += $grade->value;
        }
        $average = round($sum / count($grades));
        return ($average >= 5.75 && $average <= 6.0) ? 6.0 : $average;
    }
}
