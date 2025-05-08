<?php

namespace App\Observers;

use App\Models\User;
use App\Models\SubjectPerformance;
use App\Models\TeachingAssignment;

class TeachingAssignmentObserver
{
    /**
     * Handle the TeachingAssignment "created" event.
     */
    public function created(TeachingAssignment $assignment): void
    {
        $students = User::where('class_id', $assignment->class_id)->get();

        foreach ($students as $student) {
            // التأكد من عدم وجود السجل مسبقًا
            $exists = SubjectPerformance::where([
                'student_id' => $student->id,
                'teaching_assignment_id' => $assignment->id,
            ])->exists();

            if (!$exists) {
                SubjectPerformance::create([
                    'student_id' => $student->id,
                    'teaching_assignment_id' => $assignment->id,
                    'grade' => 0,
                    'comment' => null
                ]);
            }
        }
    }

    /**
     * Handle the TeachingAssignment "updated" event.
     */
    public function updated(TeachingAssignment $teachingAssignment): void
    {
        //
    }

    /**
     * Handle the TeachingAssignment "deleted" event.
     */
    public function deleted(TeachingAssignment $teachingAssignment): void
    {
        //
    }

    /**
     * Handle the TeachingAssignment "restored" event.
     */
    public function restored(TeachingAssignment $teachingAssignment): void
    {
        //
    }

    /**
     * Handle the TeachingAssignment "force deleted" event.
     */
    public function forceDeleted(TeachingAssignment $teachingAssignment): void
    {
        //
    }
}
