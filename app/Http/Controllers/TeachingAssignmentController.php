<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\teaching_assignment;

class TeachingAssignmentController extends Controller
{
    /**
     * assign Subject and class to teacher
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $teacher
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function assignSubject(Request $request, User $teacher)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        $exists = $teacher->teachingAssignments()
            ->where('subject_id', $validated['subject_id'])
            ->where('class_id', $validated['classroom_id'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'هذا الإسناد موجود مسبقاً لهذا المعلم.',
            ], 422);
        }

        $assignment = $teacher->teachingAssignments()->create([
            'subject_id' => $validated['subject_id'],
            'class_id' => $validated['classroom_id'],
        ]);

        $assignment->load(['subject', 'classroom']);

        return response()->json([
            'message' => 'تم الإسناد بنجاح',
            'assignment' => [
                'id' => $assignment->id,
                'subject_id' => $assignment->subject_id,
                'subject' => $assignment->subject->name,
                'classroom' => $assignment->classroom->name,
                'teacher' => $teacher->name,
            ],
        ]);
    }
    /**
     * disAssign teacher
     * @param \App\Models\teaching_assignment $assignment
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function deleteAssignment(Teaching_assignment $assignment)
    {
        $assignment->load(['subject', 'classroom', 'teacher']);

        $subject_id = $assignment->subject_id;
        $class_id = $assignment->class_id;
        $teacher_id = $assignment->user_id;

        $assignment->delete();

        return response()->json([
            'message' => 'تم حذف الإسناد بنجاح',
            'subject_id' => $subject_id,
            'class_id' => $class_id,
            'teacher_id' => $teacher_id,
        ]);
    }

}
