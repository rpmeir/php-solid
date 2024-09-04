<?php

namespace Src\Lsp;

interface GradeRepository
{
    public function getGradesByStudentId(int $studentId): array;
}
