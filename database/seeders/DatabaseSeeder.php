<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Pedro Cruz',
            'email' => 'hr@example.com',
            'employee_id' => 'HR1',
            'department' => 'HR Department',
            'role' => 'hr',
            'job_position' => 'Hr',
            'profile_pic' => 'profiles/aRuhtyGJRZNqkaI9SHVRsSu9KP8cRInDBgH5SC6D.jpg'
        ]);
        User::factory()->create([
            'name' => 'Hannah Montano',
            'email' => 'employee@example.com',
            'employee_id' => 'emp001',
            'department' => 'Sales Department',
            'role' => 'employee',
            'job_position' => 'Manager',
            'profile_pic' => 'profiles/aRuhtyGJRZNqkaI9SHVRsSu9KP8cRInDBgH5SC6D.jpg'
        ]);
        User::factory()->create([
            'name' => 'Karina Dikor',
            'email' => 'employee2@example.com',
            'employee_id' => 'emp002',
            'department' => 'IT Department',
            'role' => 'employee',
            'job_position' => 'Web Developer',
            'profile_pic' => 'profiles/aRuhtyGJRZNqkaI9SHVRsSu9KP8cRInDBgH5SC6D.jpg'
        ]);
        User::factory()->create([
            'name' => 'Lukas L Akas',
            'email' => 'employee3@example.com',
            'employee_id' => 'emp003',
            'department' => 'Marketing Department',
            'role' => 'employee',
            'job_position' => 'Sales Lady',
            'profile_pic' => 'profiles/aRuhtyGJRZNqkaI9SHVRsSu9KP8cRInDBgH5SC6D.jpg'
        ]);
        User::factory()->create([
            'name' => 'Jay P Alku',
            'email' => 'employee4@example.com',
            'employee_id' => 'emp004',
            'department' => 'Sales Department',
            'role' => 'employee',
            'job_position' => 'Manager',
            'profile_pic' => 'profiles/aRuhtyGJRZNqkaI9SHVRsSu9KP8cRInDBgH5SC6D.jpg'
        ]);
        User::factory()->create([
            'name' => 'Juan Dela Cruz',
            'email' => 'employee5@example.com',
            'employee_id' => 'emp005',
            'department' => 'Marketing Department',
            'role' => 'employee',
            'job_position' => 'Head Manager',
            'profile_pic' => 'profiles/aRuhtyGJRZNqkaI9SHVRsSu9KP8cRInDBgH5SC6D.jpg'
        ]);
        User::factory()->create([
            'name' => 'Pedro Cruz',
            'email' => 'employee6@example.com',
            'employee_id' => 'emp006',
            'department' => 'Sales Department',
            'role' => 'employee',
            'job_position' => 'Marketing Admin',
            'profile_pic' => 'profiles/aRuhtyGJRZNqkaI9SHVRsSu9KP8cRInDBgH5SC6D.jpg'
        ]);
    }
}
