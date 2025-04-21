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
        Classroom::create([
            'name' => 'الأول',
        ]);
        Classroom::create([
            'name' => 'الثاني',
        ]);
        Classroom::create([
            'name' => 'الثالث',
        ]);
        Classroom::create([
            'name' => 'الرابع',
        ]);
        Classroom::create([
            'name' => 'الخامس',
        ]);
        Classroom::create([
            'name' => 'السادس',
        ]);

    }
}
