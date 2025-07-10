<?php

declare(strict_types=1);

namespace Src\Lsp\Application\UseCase;

use Src\Lsp\Domain\Grade;

interface AverageCalculator
{
    /**
     * Summary of calculate
     *
     * @param array<Grade> $grades
     */
    public static function calculate(array $grades): float;
}
