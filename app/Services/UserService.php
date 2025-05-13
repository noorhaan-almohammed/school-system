<?php
namespace App\Services;

use App\Models\User;
use App\Models\ParentStudent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone_number' => $data['phone_number'] ?? null,
                'class_id' => $data['class_id'] ?? null,
            ]);

            $role = $data['role'];
            $user->assignRole($role);

            if ($role === 'student') {
                isset($data['parent_id']) && ParentStudent::create([
                    'student_id' => $user->id,
                    'parent_id' => $data['parent_id'],
                ]);
            }

            $roleLabel = [
                'teacher' => 'المدرس',
                'student' => 'الطالب',
                'parent' => 'ولي الأمر'
            ];

            $roleName = $roleLabel[$role] ?? 'المستخدم';
            return "تم إنشاء $roleName بنجاح";

        } catch (\Exception $e) {
            Log::error($e);
            $roleLabel = [
                'teacher' => 'المدرس',
                'student' => 'الطالب',
                'parent' => 'ولي الأمر'
            ];
            $roleName = $roleLabel[$data['role']] ?? 'المستخدم';
            return "حدث خطأ أثناء إضافة $roleName";
        }
    }
    public function updateUser($data, $id)
    {
        $user = User::findOrFail($id);

        $user->update($data);
        $user::with('classroom');
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'class' => $user->classroom->name ?? null
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'تم حذف ' . $user->name . ' بنجاح']);
    }

    public function showUserWithSubjectAndClass($id)
    {
        $user = User::with(['subjectPerformances.teachingAssignment.subject', 'overallPerformance', 'subjectPerformances.teachingAssignment.classroom'])
            ->findOrFail($id);

        return response()->json(
            [
                'id' => $user->id,
                'name' => $user->name,
                'overallPerformance' => $user->overallPerformance->performance ?? 0,
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
    public function showParentWithChildren($id)
    {
        $user = User::with([
            'children',
            'children.attendances',
            'children.overallPerformance',
            'children.subjectPerformances.teachingAssignment.subject',
            'children.subjectPerformances.teachingAssignment.classroom'
        ])
            ->findOrFail($id);
        return response()->json(
            [
                'id' => $user->id,
                'name' => $user->name,
                'children' => $user->children->map(
                    function ($child) {
                        return [
                            'id' => $child->id,
                            'name' => $child->name,
                            'attendances' => $child->attendances->map(
                                function ($attendance) {
                                    return [
                                        'id' => $attendance->id,
                                        'subject' => $attendance->teachingAssignment->subject->name,
                                        'status' => $attendance->status,
                                        'date' => $attendance->date
                                    ];
                                }
                            ),
                            'overallPerformance' => $child->overallPerformance->performance ?? 0,
                            'subject_performances' => $child->subjectPerformances->map(
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
                        ];
                    }
                ),
            ]
        );
    }
    public function showUserInfo($role, $id)
    {
        if ($role == 'student') {
            return $this->showUserWithSubjectAndClass($id);
        } elseif ($role == 'parent') {
            return $this->showParentWithChildren($id);

        }
    }
    public function allTeachers()
    {
        $teachers = User::role('teacher')->with(['teachingAssignments.subject', 'teachingAssignments.classroom'])->get()->map(
            function ($teacher) {
                return [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                    'teaching_assignment' => $teacher->teachingAssignments->map(
                        function ($teachingAssignment) {
                            return [
                                'subject_id' => $teachingAssignment->subject->id,
                                'subject_name' => $teachingAssignment->subject->name,
                                'class_id' => $teachingAssignment->classroom->id,
                                'class_name' => $teachingAssignment->classroom->name
                            ];
                        }
                    )
                ];
            }
        );
        return $teachers;
    }
}
