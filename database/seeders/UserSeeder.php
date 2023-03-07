<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Administrator
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('administrator');

        //Teachers
        User::create([
            'name' => 'Teacher 1',
            'email' => 'teacher1@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('teacher');

        User::create([
            'name' => 'Teacher 2',
            'email' => 'teacher2@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('teacher');

        //Students
        User::create([
            'name' => 'Student 1',
            'email' => 'student1@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 2',
            'email' => 'student2@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 3',
            'email' => 'student3@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 4',
            'email' => 'student4@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 5',
            'email' => 'student5@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 6',
            'email' => 'student6@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 7',
            'email' => 'student7@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 8',
            'email' => 'student8@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 9',
            'email' => 'student9@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

        User::create([
            'name' => 'Student 10',
            'email' => 'student10@admin.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
        ])->assignRole('student');

    }
}
