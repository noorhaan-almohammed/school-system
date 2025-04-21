<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ParentStudent;
use Illuminate\Database\Seeder;

class ParentStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // all parents and students
        $parents = User::role('parent')->get();
        $students = User::role('student')->get();

        // Randomize the student order.
        $shuffledStudents = $students->shuffle();

        $parent_student = [];
        $parentCount = $parents->count();
        $studentCount = $shuffledStudents->count();

        for ($i = 0; $i < $parentCount; $i++) {
            $parent_student[] = [
                'parent_id'  => $parents[$i]->id,
                'student_id' => $shuffledStudents[$i]->id,
            ];
        }

        for ($i = $parentCount; $i < $studentCount; $i++) {
            $parent_student[] = [
                'parent_id'  => $parents->random()->id,
                'student_id' => $shuffledStudents[$i]->id,
            ];
        }

        foreach ($parent_student as $x) {
            ParentStudent::create($x);
        }
    }
}
