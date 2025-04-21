<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroom = Classroom::create([
            'name' => 'الأول',
        ]);
        $classroom = Classroom::create([
            'name' => 'الثاني',
        ]);
        $classroom = Classroom::create([
            'name' => 'الثالث',
        ]);
        $classroom = Classroom::create([
            'name' => 'الرابع',
        ]);
        $classroom = Classroom::create([
            'name' => 'الخامس',
        ]);
        $classroom = Classroom::create([
            'name' => 'السادس',
        ]);

    }
}
