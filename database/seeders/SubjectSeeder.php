<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subject = Subject::create([
            'name' => 'رياضيات',
        ]);
        $subject = Subject::create([
            'name' => 'عربي',
        ]);
        $subject = Subject::create([
            'name' => 'علوم',
        ]);
        $subject = Subject::create([
            'name' => 'لغة',
        ]);
    }
}
