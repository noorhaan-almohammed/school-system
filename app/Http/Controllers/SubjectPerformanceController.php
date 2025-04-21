<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectPerformance;
use App\Services\SubjectPerformanceService;
use App\Http\Resources\SubjectPerformanceResource;

class SubjectPerformanceController extends Controller
{
    protected SubjectPerformanceService $subjectPerformanceService;
    public function __construct(SubjectPerformanceService $subjectPerformanceService)
    {
        $this->subjectPerformanceService = $subjectPerformanceService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubjectPerformance $subjectPerformance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubjectPerformance $subjectPerformance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubjectPerformance $subjectPerformance)
    {
        //
    }
    public function showPerformanceForSubject(User $student,Subject $subject)
    {
        $SubjectPerformance = $this->subjectPerformanceService->showPerformanceForSubject($student,$subject);
        return self::success(new SubjectPerformanceResource($SubjectPerformance), 'Stuent Performance Retrieved Successfully',200);
    }
    public function showPerformanceForAllSubjects(User $student)
    {
        $SubjectPerformance = $this->subjectPerformanceService->showPerformanceForAllSubjects($student);
        return self::success( SubjectPerformanceResource::collection($SubjectPerformance), 'Stuent Performance Retrieved Successfully',200);
    }

}
