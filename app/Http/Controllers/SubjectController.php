<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\CreateSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Subject;
use App\Services\Subject\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected SubjectService $subjectService ;
    public function __construct(SubjectService $subjectService){
        $this->subjectService = $subjectService ;
    }
    /**
     * Display a paginated list of all subjects with their related teachers and classes.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $subjects = Subject::with(['teachers:name,email,phone_number','classes:name'])->paginate(5);
        return $this->success($subjects);
    }

    /**
     * Store a newly created subject in the database.
     * @param \App\Http\Requests\Subject\CreateSubjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateSubjectRequest $request)
    {
        $subject = $this->subjectService->createSubject($request->validated());
        return $this->success($subject , 'Done Successfully!',201);
    }

    /**
     * Display the specified subject with its related teachers and classes.
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Subject $subject)
    {
        return $this->success($subject->load(['teachers:name,email,phone_number','classes:name']));
    }

    /**
     * Update the specified subject in the database.
     * @param \App\Http\Requests\Subject\UpdateSubjectRequest $request
     * @param \App\Models\Subject $subject
     * @return Subject
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        return $this->subjectService->updateSubject($request->validated(),$subject);
    }

    /**
     * Remove the specified subject from the database.
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return $this->success(null , 'Deleted Successfully');
    }
}
