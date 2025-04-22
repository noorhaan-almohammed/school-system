<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'المدير',
            'email' => 'Admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin@12345678'),
            'phone_number' => fake()->phoneNumber,
            'class_id' => null,
        ]);
        $admin->assignRole('admin');

        for ($i = 1; $i <= 5; $i++) {
            $teacher = User::create([
                'name' => "الاستاذ {$i}",
                'email' => "Teacher{$i}@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('Teacher@12345678'),
                'phone_number' => fake()->phoneNumber,
                'class_id' => null,
            ]);
            $teacher->assignRole('teacher');
        }
        for ($i = 1; $i <= 25; $i++) {
            $parent = User::create([
                'name' => "اهل {$i}",
                'email' => "Parent{$i}@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('Parent@12345678'),
                'phone_number' => fake()->phoneNumber,
                'class_id' => null,
            ]);
            $parent->assignRole('parent');
        }

        for ($i = 1; $i <= 50; $i++) {
            $student = User::create([
                'name' => "طالب{$i}",
                'email' => "Student{$i}@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('Student@12345678'),
                'phone_number' => null,
                'class_id' => random_int(1,8),
            ]);
            $student->assignRole('student');
        }

}
}
