<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use App\Models\teaching_assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        teaching_assignment::create([
            'class_id'   => $classrooms[1],
            'subject_id' => $subjects[1],
            'teacher_id' => $teachers[1],
        ]);
        teaching_assignment::create([
            'class_id'   => $classrooms[2],
            'subject_id' => $subjects[1],
            'teacher_id' => $teachers[1],
        ]);

        teaching_assignment::create([
            'class_id'   => $classrooms[3],
            'subject_id' => $subjects[3],
            'teacher_id' => $teachers[2],
        ]);
        teaching_assignment::create([
            'class_id'   => $classrooms[4],
            'subject_id' => $subjects[3],
            'teacher_id' => $teachers[2],
        ]);


        teaching_assignment::create([
            'class_id'   => $classrooms[4],
            'subject_id' => $subjects[4],
            'teacher_id' => $teachers[3],
        ]);
        teaching_assignment::create([
            'class_id'   => $classrooms[5],
            'subject_id' => $subjects[4],
            'teacher_id' => $teachers[3],
        ]);
        teaching_assignment::create([
            'class_id'   => $classrooms[6],
            'subject_id' => $subjects[4],
            'teacher_id' => $teachers[3],
        ]);


        teaching_assignment::create([
            'class_id'   => $classrooms[1],
            'subject_id' => $subjects[2],
            'teacher_id' => $teachers[4],
        ]);
        teaching_assignment::create([
            'class_id'   => $classrooms[5],
            'subject_id' => $subjects[2],
            'teacher_id' => $teachers[4],
        ]);


        teaching_assignment::create([
            'class_id'   => $classrooms[6],
            'subject_id' => $subjects[1],
            'teacher_id' => $teachers[5],
        ]);


    }
}
