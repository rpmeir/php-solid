<?php

declare(strict_types=1);

namespace Src\Lsp;

class Average
{
    public function __construct(
        public readonly int $student_id,
        public readonly float $value
    ) {
    }
}
