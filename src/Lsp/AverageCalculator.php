<?php

namespace Src\Lsp;

interface AverageCalculator
{
    /**
     * Summary of calculate
     * @param array<Grade> $grades
     * @return float
     */
    public static function calculate(array $grades): float;
}
