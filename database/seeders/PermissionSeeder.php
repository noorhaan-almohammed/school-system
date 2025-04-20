<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            //Admin permissions
            'manage users',
            'manage classes',
            'manage subjects',
            'manage teaching assignments',
            'manage payments',
            'manage events',
            'assign roles',

            // Teacher permissions
            'view assigned classes',
            'manage attendance',
            'manage grades',
            'comment on performance',
            'communicate with students',
            'communicate with parents',

            // Parent permissions
            'view student performance',
            'view student attendance',
            'view student payments',
            'communicate with teachers',

             // Student permissions
             'view own performance',
             'view own attendance',
             'communicate with teachers',
            ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission,'guard_name' => 'api']);
        }    }
}
