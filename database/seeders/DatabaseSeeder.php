<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123456789',
            'phone_number' => "09351454778"
        ]);
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SubjectSeeder::class,
            ClassRoomSeeder::class,
        ]);
    }
}
