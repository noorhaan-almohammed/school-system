<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OverallPerformances;
use App\Http\Resources\OverallPerformanceResource;

class OverallPerformancesController extends Controller
{
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
    public function show(OverallPerformances $overallPerformances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OverallPerformances $overallPerformances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OverallPerformances $overallPerformances)
    {
        //
    }
    public function OverallPerformance(User $student)
    {
        $OverallPerformance = $student->load('overallPerformance');
        return self::success( new OverallPerformanceResource($OverallPerformance), 'Student All Performance Retrieved Successfully',200);

    }

}
