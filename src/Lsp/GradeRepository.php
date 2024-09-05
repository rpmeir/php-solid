<?php

namespace Src\Lsp;

interface GradeRepository
{
    /**
     * Summary of getGradesByStudentId
     * @param int $studentId
     * @return array<Grade>
     */
    public function getGradesByStudentId(int $studentId): array;
}
