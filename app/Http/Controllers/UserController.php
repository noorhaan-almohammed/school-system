<?php

namespace App\Http\Controllers;

use App\Models\teaching_assignment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\RegisterService;
use App\Http\Requests\Auth\RegisterRequest;

class UserController extends Controller
{
    protected RegisterService $RegisterService;

    public function __construct(RegisterService $RegisterService)
    {
        $this->RegisterService = $RegisterService;
    }
    public function createUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $msg = $this->RegisterService->createUser($data);
        return redirect()->back()->with('success', $msg);
    }

    public function showTeacher($id)
    {
        $teacher = User::role('teacher')->findOrFail($id);
        return response()->json($teacher);
    }

    public function updateTeacher(Request $request, $id)
    {
        $teacher = User::role('teacher')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
            'phone_number' => 'nullable|string|max:20',
        ]);

        $teacher->update($validated);

        // إرجاع بيانات المعلم المحدثة
        return response()->json([
            'id' => $teacher->id,
            'name' => $teacher->name,
            'email' => $teacher->email,
            'phone_number' => $teacher->phone_number,
        ]);
    }

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
                'subject' => $assignment->subject->name,
                'classroom' => $assignment->classroom->name,
            ],
        ]);
    }
    public function deleteAssignment(Teaching_assignment $assignment)
    {
        $assignment->delete();

        return response()->json(['message' => 'تم حذف الإسناد بنجاح']);
    }

}
