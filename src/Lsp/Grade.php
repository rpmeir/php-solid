<?php

declare(strict_types=1);

namespace Src\Lsp;

class Grade
{
    public function __construct(
        public readonly int $student_id,
        public readonly string $exam,
        public readonly float $value
    ) {
    }
}
