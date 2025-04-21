<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\SubjectPerformance;
use App\Models\teaching_assignment;

class SubjectPerformenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = teaching_assignment::all();
        $students = User::role('student')->get();

        foreach ($students as $student) {
            $teachingAssignment = $assignments->random();
            $grade = mt_rand(3000, 10000) / 100; // For example 75.32
            if ($grade >= 90) {
                $comment = "Excellent";
            } elseif ($grade >= 75) {
                $comment = "Very Good";
            } elseif ($grade >= 60) {
                $comment = "Good";
            } else {
                $comment = "Bad";
            }

            SubjectPerformance::create([
                'student_id'             => $student->id,
                'teaching_assignment_id' => $teachingAssignment->id,
                'grade'                  => $grade,
                'comment'                => $comment,
            ]);
        }
    }
}
