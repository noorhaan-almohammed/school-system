<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ParentStudent;

class ParentStudentController extends Controller
{
    public function assignChild(Request $request, User $parent)
    {
        $request->validate([
            'child_id' => 'required|exists:users,id',
        ]);

        if ($parent->children()->where('student_id', $request->child_id)->exists()) {
            return response()->json([
                'message' => 'هذا الطالب مضاف بالفعل لهذا ولي الأمر.',
            ], 422);
        }

        $parent->children()->attach($request->child_id);

        $pivot = $parent->children()
            ->where('student_id', $request->child_id)
            ->first()
            ->pivot;

        return response()->json([
            'message' => 'تم إسناد الطالب بنجاح',
            'child' => [
                'id' => $request->child_id,
                'name' => User::find($request->child_id)->name,
            ],
            'assignment_id' => $pivot->id, 
        ]);
    }


    public function deleteChild(ParentStudent $assignment)
    {
        $assignment->delete();

        return response()->json([
            'message' => 'تم حذف الإسناد بنجاح',
            'parent_id' => $assignment->parent_id,
            'student_id' => $assignment->student_id,
        ]);
    }
}
