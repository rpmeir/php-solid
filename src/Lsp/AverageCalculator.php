<?php

namespace Src\Lsp;

interface AverageCalculator
{
    public static function calculate(array $grades): float;
}
