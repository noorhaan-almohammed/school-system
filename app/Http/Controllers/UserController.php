<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\UserService;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UpdateUser;
use App\Http\Requests\Auth\RegisterRequest;

class UserController extends Controller
{
    protected UserService $UserService;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }
    /**
     * create user with role depends on the form
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $msg = $this->UserService->createUser($data);
        return redirect()->back()->with('success', $msg);
    }
    /**
     * show user by $id
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    /**
     * show user by $id
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function showUserWithSubjectAndClass($id)
    {
        $user = User::with(['subjectPerformances.teachingAssignment.subject', 'overallPerformance', 'subjectPerformances.teachingAssignment.classroom'])
            ->findOrFail($id);

        return response()->json(
            [
                'id' => $user->id,
                'name' => $user->name,
                'overallPerformance' => $user->overallPerformance->performance,
                'subject_performances' => $user->subjectPerformances->map(
                    function ($performance) {
                        return [
                            'id' => $performance->id,
                            'grade' => $performance->grade,
                            'comment' => $performance->comment,
                            'teaching_assignment_id' => $performance->teaching_assignment_id,
                            'teaching_assignment' => [
                                'subject' => $performance->teachingAssignment->subject->name ?? '',
                                'classroom' => $performance->teachingAssignment->classroom->name ?? '',
                                'id' => $performance->teachingAssignment->id,
                            ]
                        ];
                    }
                )
            ]
        );
    }

    /**
     * update user info
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateUser(UpdateUser $request, $id)
    {
        $data = $request->validated();
        return $this->UserService->updateUser($data, $id);
    }

    public function deleteUser($id)
    {
        return $this->UserService->deleteUser($id);
    }
    public function allStudents()
    {
        $students = $this->UserService->allStudents();
        return self::paginated($students, UserResource::class, 'Students retrieved successfully', 200);
    }
    public function allParents()
    {
        $parents = $this->UserService->allParents();
        return self::paginated($parents, UserResource::class, 'Parents retrieved successfully', 200);
    }
    public function allTeacher()
    {
        $teachers = $this->UserService->allTeachers();
        return self::paginated($teachers, UserResource::class, 'Teachers retrieved successfully', 200);
    }
}
