<?php

namespace Src\Lsp;

class GradeRepositoryDatabase implements GradeRepository
{
    public function __construct(public readonly DatabaseConnection $databaseConnection) {}

    /**
     * Summary of getGradesByStudentId
     * @param int $studentId
     * @return array<Grade>
     */
    public function getGradesByStudentId(int $studentId): array
    {
        $grades = $this->databaseConnection->query(
            'SELECT student_id, exam, value FROM lsp.grades WHERE student_id = ?',
            [$studentId]
        );
        return array_map(
            function($grade) {
            return new Grade(
                (int) $grade['student_id'],
                (string) $grade['exam'],
                (float) $grade['value']);
            },
            $grades
        );
    }
}
