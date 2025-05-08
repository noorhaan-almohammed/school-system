<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectPerformance;
use Illuminate\Support\Facades\Auth;
use App\Services\SubjectPerformanceService;
use App\Http\Resources\SubjectPerformanceResource;
use App\Http\Requests\SubjectPerformance\CreateSubjectPerformanceRequest;
use App\Http\Requests\SubjectPerformance\UpdateSubjectPerformanceRequest;


class SubjectPerformanceController extends Controller
{
    protected SubjectPerformanceService $subjectPerformanceService;
    public function __construct(SubjectPerformanceService $subjectPerformanceService)
    {
        $this->subjectPerformanceService = $subjectPerformanceService;
    }
    /**
     * Display a paginated list of subject performances
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $subjectsPerformace = SubjectPerformance::paginate(10);
        return response()->json($subjectsPerformace);
    }

    /**
     * Store a new subject performance record
     * @param \App\Http\Requests\SubjectPerformance\CreateSubjectPerformanceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSubjectPerformanceRequest $request)
    {
        $data = $request->validated();
        $msg = $this->subjectPerformanceService->createSubjectPerformance($data);
        return redirect()->back()->with('status', $msg);
    }

    /**
     * Show a single subject performance record by ID
     * @param string $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $subjectPerformace = SubjectPerformance::findOrFail($id);
        return response()->json($subjectPerformace);
    }

    /**
     * Update an existing subject performance record
     * @param \App\Http\Requests\SubjectPerformance\UpdateSubjectPerformanceRequest $request
     * @param string $id
     * @return string
     */
    public function update(UpdateSubjectPerformanceRequest $request, string $id)
    {
        $data = $request->validated();
        return $this->subjectPerformanceService->updateSubjectPerformance($data, $id);
    }

    /**
     * Delete a subject performance record
     * @param string $id
     * @return string
     */
    public function destroy(string $id)
    {
        return $this->subjectPerformanceService->deleteSubjectPerformance($id);
    }
    /**
     * Get a student's performance in a specific subject
     * @param \App\Models\User $student
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function showPerformanceForSubject(User $student, Subject $subject)
    {
        $SubjectPerformance = $this->subjectPerformanceService->showPerformanceForSubject($student, $subject);
        return self::success(new SubjectPerformanceResource($SubjectPerformance), 'Stuent Performance Retrieved Successfully', 200);
    }
    /**
     * Get a student's performance across all subjects
     * @param \App\Models\User $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function showPerformanceForAllSubjects(User $student)
    {
        $SubjectPerformance = $this->subjectPerformanceService->showPerformanceForAllSubjects($student);
        return self::success(SubjectPerformanceResource::collection($SubjectPerformance), 'Stuent Performance Retrieved Successfully', 200);
    }
    /**
     * add or update student performnce belong to teacher
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateStudentGrades(Request $request)
    {
        $studentId = $request->input('id');
        $grades = $request->input('grades');
        $teacher = Auth::user();

        /** @var \App\Models\User $teacher */

        if (!$teacher->students()->where('id', $studentId)->exists()) {
            return response()->json(['message' => 'ليس لديك صلاحية لتعديل هذا الطالب'], 403);
        }
        foreach ($grades as $assignmentId => $values) {
            SubjectPerformance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'teaching_assignment_id' => $assignmentId,
                ],
                [
                    'grade' => $values['grade'],
                    'comment' => $values['comment'] ?? null,
                ]
            );
        }

        return response()->json(['message' => 'تم حفظ الدرجات بنجاح']);
    }
}
