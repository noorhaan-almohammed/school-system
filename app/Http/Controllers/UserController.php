<?php

namespace App\Http\Controllers;

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

}
