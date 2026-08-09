<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        $companyRole = \Spatie\Permission\Models\Role::create(['name' => 'company']);
        $seekerRole = \Spatie\Permission\Models\Role::create(['name' => 'seeker']);

        // Create Admin User
        $admin = \App\Models\User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@wuzzuf.test',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($adminRole);

        // Create Company User
        $companyUser = \App\Models\User::factory()->create([
            'first_name' => 'Tech Corp',
            'last_name' => 'HR',
            'email' => 'hr@techcorp.test',
            'password' => bcrypt('password'),
        ]);
        $companyUser->assignRole($companyRole);

        \App\Models\Company::create([
            'user_id' => $companyUser->id,
            'name' => 'Tech Corp',
            'industry' => 'Software Development',
            'location' => 'Cairo, Egypt',
            'description' => 'A leading software company in Egypt.',
            'is_verified' => true
        ]);

        // Create Seeker User
        $seeker = \App\Models\User::factory()->create([
            'first_name' => 'Ahmed',
            'last_name' => 'Ali',
            'email' => 'ahmed@example.test',
            'password' => bcrypt('password'),
            'birth_date' => '2000-01-01',
        ]);
        $seeker->assignRole($seekerRole);

        // Create Some Skills
        $skills = ['PHP', 'Laravel', 'JavaScript', 'React', 'MySQL'];
        foreach ($skills as $skill) {
            \App\Models\Skill::create(['name' => $skill]);
        }

        // Create Dummy Job
        \App\Models\Job::create([
            'company_id' => 1,
            'title' => 'Senior Laravel Developer',
            'description' => 'We are looking for a Senior Laravel Developer to join our team.',
            'requirements' => '3+ years of experience with Laravel. Good knowledge of MySQL and REST APIs.',
            'type' => 'full-time',
            'location' => 'Cairo, Egypt / Remote',
            'salary_range' => '20,000 - 35,000 EGP',
            'status' => 'open'
        ]);
    }
}
