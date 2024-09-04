<?php

namespace Src\Lsp;

class Average
{
    public function __construct(
        public readonly int $student_id,
        public readonly float $value)
    {
    }
}
