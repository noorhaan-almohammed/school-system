<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Admin Role
         $webAdminPermissions = Permission::where('guard_name', 'web')->get();
         $web_admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
         $web_admin->syncPermissions($webAdminPermissions);

         // صلاحيات API فقط للأدوار API
         $apiAdminPermissions = Permission::where('guard_name', 'api')->get();
         $api_admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
         $api_admin->syncPermissions($apiAdminPermissions);

         //Teacher Role
         $web_teacher = Role::create(['name' => 'teacher', 'guard_name' => 'web']);
         $api_teacher = Role::create(['name' => 'teacher', 'guard_name' => 'api']);
         $teacherPermissions = [
             'view assigned classes',
             'manage attendance',
             'manage grades',
             'comment on performance',
             'communicate with students',
             'communicate with parents',
         ];
         $web_teacher->syncPermissions($teacherPermissions);
         $api_teacher->syncPermissions($teacherPermissions);

         //Parent Role
         $web_parent = Role::create(['name' => 'parent', 'guard_name' => 'web']);
         $api_parent = Role::create(['name' => 'parent', 'guard_name' => 'api']);
         $parentPermissions = [
            'view student performance',
            'view student attendance',
            'view student payments',
            'communicate with teachers',
         ];
         $api_parent->syncPermissions($parentPermissions);
         $web_parent->syncPermissions($parentPermissions);

         //Student Role
         $web_student = Role::create(['name' => 'student', 'guard_name' => 'web']);
         $api_student = Role::create(['name' => 'student', 'guard_name' => 'api']);

         $studentPermissions = [
            'view own performance',
            'view own attendance',
            'communicate with teachers',
         ];
         $web_student->syncPermissions($studentPermissions);
         $api_student->syncPermissions($studentPermissions);

    }
}
