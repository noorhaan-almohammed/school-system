<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\CreateSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Subject;
use App\Services\SubjectService;
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
        $subjects = Subject::with(['teachers:name,email,phone_number','classes:name'])->get();
        return $this->success($subjects);
    }

    /**
     * Store a newly created subject in the database.
     * @param \App\Http\Requests\Subject\CreateSubjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSubjectRequest $request)
    {
        $msg = $this->subjectService->createSubject($request->validated());
        return redirect()->back()->with('success',$msg);
    }

    /**
     * Display the specified subject with its related teachers and classes.
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $Subject = Subject::find($id);
        return response()->json($Subject);
    }

    /**
     * Update the specified subject in the database.
     * @param \App\Http\Requests\Subject\UpdateSubjectRequest $request
     * @param \App\Models\Subject $subject
     * @return Subject
     */
    public function update(UpdateSubjectRequest $request, $id)
    {
        return $this->subjectService->updateSubject($request->validated(),$id);
    }

    /**
     * Remove the specified subject from the database.
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $data = $this->subjectService->delete($id);
        return redirect()->back()->with($data['status'],$data['message']);
    }
}
