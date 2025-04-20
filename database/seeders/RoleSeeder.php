<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Admin Role
         $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
         $admin->syncPermissions(Permission::all());

         //Teacher Role
         $teacher = Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'api']);
         $teacherPermissions = [
             'view assigned classes',
             'manage attendance',
             'manage grades',
             'comment on performance',
             'communicate with students',
             'communicate with parents',
         ];
         $teacher->syncPermissions($teacherPermissions);

         //Parent Role
         $parent = Role::firstOrCreate(['name' => 'parent', 'guard_name' => 'api']);
         $parentPermissions = [
            'view student performance',
            'view student attendance',
            'view student payments',
            'communicate with teachers',
         ];
         $parent->syncPermissions($parentPermissions);

         //Student Role
         $student = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'api']);
         $studentPermissions = [
            'view own performance',
            'view own attendance',
            'communicate with teachers',
         ];
         $student->syncPermissions($studentPermissions);
    }
}
