<?php

namespace App\Observers;

use App\Models\User;
use App\Models\SubjectPerformance;
use App\Models\TeachingAssignment;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ( $user->class_id) {
            $assignments = TeachingAssignment::where('class_id', $user->class_id)->get();
            foreach ($assignments as $assignment) {
                    SubjectPerformance::create([
                        'student_id' => $user->id,
                        'teaching_assignment_id' => $assignment->id,
                        'grade' => 0,
                        'comment' => null
                    ]);
            }
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->isDirty('class_id') && $user->class_id) {
            $assignments = TeachingAssignment::where('class_id', $user->class_id)->get();
            SubjectPerformance::where([
                'student_id' => $user->id,
            ])->delete();
            foreach ($assignments as $assignment) {
                    SubjectPerformance::create([
                        'student_id' => $user->id,
                        'teaching_assignment_id' => $assignment->id,
                        'grade' => 0,
                        'comment' => null
                    ]);

            }
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
