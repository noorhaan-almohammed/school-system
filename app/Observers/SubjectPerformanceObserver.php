<?php

namespace App\Observers;

use App\Models\SubjectPerformance;
use App\Models\OverallPerformances;

class SubjectPerformanceObserver
{
    public function saved(SubjectPerformance $subjectPerformance)
    {
        $studentId = $subjectPerformance->student_id;

        $average = SubjectPerformance::where('student_id', $studentId)->avg('grade');

        $average = $average ? round($average, 2) : 0;

        OverallPerformances::updateOrCreate(
            ['student_id' => $studentId],
            ['performance' => $average]
        );
    }
    /**
     * Handle the SubjectPerformance "created" event.
     */
    public function created(SubjectPerformance $subjectPerformance): void
    {
        //
    }

    /**
     * Handle the SubjectPerformance "updated" event.
     */
    public function updated(SubjectPerformance $subjectPerformance): void
    {
        //
    }

    /**
     * Handle the SubjectPerformance "deleted" event.
     */
    public function deleted(SubjectPerformance $subjectPerformance): void
    {
        //
    }

    /**
     * Handle the SubjectPerformance "restored" event.
     */
    public function restored(SubjectPerformance $subjectPerformance): void
    {
        //
    }

    /**
     * Handle the SubjectPerformance "force deleted" event.
     */
    public function forceDeleted(SubjectPerformance $subjectPerformance): void
    {
        //
    }
}
