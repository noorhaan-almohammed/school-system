<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use App\Models\TeachingAssignment;

class TeachingAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects   = Subject::all();
        $classrooms = Classroom::all();
        $teachers   = User::role('teacher')->get();

        $assignments = [
            [$classrooms[1]->id, $subjects[1]->id, $teachers[1]->id],
            [$classrooms[2]->id, $subjects[1]->id, $teachers[1]->id],
            [$classrooms[3]->id, $subjects[3]->id, $teachers[2]->id],
            [$classrooms[4]->id, $subjects[3]->id, $teachers[2]->id],
            [$classrooms[4]->id, $subjects[4]->id, $teachers[3]->id],
            [$classrooms[5]->id, $subjects[4]->id, $teachers[3]->id],
            [$classrooms[1]->id, $subjects[2]->id, $teachers[4]->id],
            [$classrooms[5]->id, $subjects[2]->id, $teachers[4]->id],
        ];

        foreach ($assignments as [$class_id, $subject_id, $teacher_id]) {
            TeachingAssignment::create([
                'class_id'   => $class_id,
                'subject_id' => $subject_id,
                'teacher_id' => $teacher_id,
            ]);
        }
    }
}
