<?php

namespace Src\Lsp;

class GradeRepositoryDatabase implements GradeRepository
{
    public function __construct(public readonly DatabaseConnection $databaseConnection) {}

    public function getGradesByStudentId(int $studentId): array
    {
        $grades = $this->databaseConnection->query(
            'SELECT student_id, exam, value FROM lsp.grades WHERE student_id = ?',
            [$studentId]
        );
        return array_map(fn($grade) => new Grade(...$grade), $grades);
    }
}
