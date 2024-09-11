<?php

declare(strict_types=1);

namespace Src\Lsp;

use Src\DatabaseConnection;

class GradeRepositoryDatabase implements GradeRepository
{
    public function __construct(public readonly DatabaseConnection $databaseConnection)
    {
    }

    /**
     * Summary of getGradesByStudentId
     *
     * @return array<Grade>
     */
    public function getGradesByStudentId(int $studentId): array
    {
        $grades = $this->databaseConnection->query(
            'SELECT student_id, exam, value FROM lsp.grades WHERE student_id = ?',
            [$studentId]
        );
        return array_map(
            static function ($grade) {
                return new Grade(
                    (int) $grade['student_id'],
                    (string) $grade['exam'],
                    (float) $grade['value']
                );
            },
            $grades
        );
    }
}
