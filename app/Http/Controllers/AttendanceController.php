<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'status' => 'required|boolean',
            'teaching_assignment_id' => 'required|exists:teaching_assignments,id',
        ]);

        $data = [
            'student_id' => $request->student_id,
            'date' => Carbon::today()->toDateString(),
        ];
        $data['teaching_assignment_id'] = $request->teaching_assignment_id;

        $attendance = Attendance::firstOrNew($data);
        $attendance->status = $request->status;

        $attendance->teaching_assignment_id = $request->teaching_assignment_id;
        $attendance->save();

        return response()->json(['success' => true]);
    }
    public function summary(User $student)
    {
        $start = now()->startOfYear();
        $end = now();

        // احتساب كل الأيام عدا الجمعة والسبت
        $allDays = collect();
        for ($date = $start->copy(); $date <= $end; $date->addDay()) {
            if (!in_array($date->dayOfWeek, [Carbon::FRIDAY, Carbon::SATURDAY])) {
                $allDays->push($date->toDateString());
            }
        }

        $attendances = $student->attendances()->whereBetween('date', [$start, $end])->get();

        $presentDays = $attendances->where('status', true)->count();
        $absentDays = $allDays->count() - $presentDays;

        $rate = $allDays->count() > 0 ? round(($presentDays / $allDays->count()) * 100, 1) : 0;

        return response()->json([
            'success' => true,
            'presentDays' => $presentDays,
            'absentDays' => $absentDays,
            'attendanceRate' => $rate
        ]);
    }

}
