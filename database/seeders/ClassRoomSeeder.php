<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'الصف الأول',
            'الصف الثاني',
            'الصف الثالث',
            'الصف الرابع',
            'الص الخامس',
            'الصف السادس',
            'الصف السابع',
            'الصف الثامن',
            'الصف التاسع',
            'السف العاشر',
            'الصف الحادي عشر',
            'الصف الثاني عشر',
        ];
        foreach($classes as $class){
            Classroom::create([
                'name'=>$class,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
