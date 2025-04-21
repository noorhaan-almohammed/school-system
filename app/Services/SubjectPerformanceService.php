<?php

namespace App\Services;

use App\Models\Subject;
use App\Models\User;

class SubjectPerformanceService
{

    public function showPerformanceForSubject(User $student,Subject $subject)
    {
        return $student->getPerformanceForSubject($subject);
    }
    public function showPerformanceForAllSubjects(User $student)
    {
        return $student->load('subjectPerformances');
    }
}
