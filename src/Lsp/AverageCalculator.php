<?php

declare(strict_types=1);

namespace Src\Lsp;

interface AverageCalculator
{
    /**
     * Summary of calculate
     *
     * @param array<Grade> $grades
     */
    public static function calculate(array $grades): float;
}
