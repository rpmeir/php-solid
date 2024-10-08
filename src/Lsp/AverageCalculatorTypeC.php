<?php

declare(strict_types=1);

namespace Src\Lsp;

class AverageCalculatorTypeC implements AverageCalculator
{
    /**
     * Summary of calculate
     *
     * @param array<Grade> $grades
     */
    public static function calculate(array $grades): float
    {
        if (empty($grades)) {
            return 0;
        }
        usort($grades, static function ($a, $b) {
            return $a->value <=> $b->value;
        });
        array_shift($grades);
        array_pop($grades);
        $sum = 0;
        foreach ($grades as $grade) {
            if ($grade->value > 10) {
                throw new InvalidGradeException('Invalid Grade', 1);
            }
            $sum += $grade->value;
        }
        return $sum / count($grades);
    }
}
