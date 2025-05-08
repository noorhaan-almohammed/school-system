<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EventsSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            ClassroomSeeder::class,
            SubjectSeeder::class,
            UserSeeder::class,
            ParentStudentSeeder::class,
            TeachingAssignmentSeeder::class,
            // SubjectPerformenceSeeder::class,
        ]);
    }
}
