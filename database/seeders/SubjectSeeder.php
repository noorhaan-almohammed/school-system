<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            'اللغة العربية',
            'اللغة الإنجلزية',
            'اللغة الفرنسية',
            'الرياضيات',
            'التربية الدينية',
            'التربية الوطنية',
            'التربية الفنية',
            'التربية الموسيقية',
            'الرياضة',
            'العلوم',
            'التكنولوجيا',
        ];
        foreach($subjects as $subject){
            Subject::create([
                'name'=>$subject,
            ]);
        }
    }
}
