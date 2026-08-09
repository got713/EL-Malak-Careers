<?php

namespace Tests\Feature\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Resume;
use App\Models\Job;
use App\Models\Company;
use App\Models\Application;
use Spatie\Permission\Models\Role;

class FileSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'company']);
        Role::create(['name' => 'seeker']);
    }

    public function test_unauthenticated_user_cannot_download_resumes()
    {
        $user = User::factory()->create();
        $resume = Resume::create([
            'user_id' => $user->id,
            'file_path' => 'cvs/test_cv.pdf',
            'original_name' => 'test_cv.pdf',
        ]);

        $response = $this->get(route('resumes.download', $resume));
        $response->assertRedirect(route('login'));
    }

    public function test_cross_user_recommendation_download_is_forbidden()
    {
        $userA = User::factory()->create(['recommendation_letter' => 'recommendations/letter.pdf']);
        $userA->assignRole('seeker');

        $userB = User::factory()->create();
        $userB->assignRole('seeker');

        $response = $this->actingAs($userB)->get(route('users.recommendation.download', $userA));
        $response->assertStatus(403);
    }

    public function test_admin_can_download_any_recommendation_letter()
    {
        Storage::fake('local');
        Storage::disk('local')->put('recommendations/letter.pdf', 'Dummy Recommendation Content');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $seeker = User::factory()->create(['recommendation_letter' => 'recommendations/letter.pdf']);
        $seeker->assignRole('seeker');

        $response = $this->actingAs($admin)->get(route('users.recommendation.download', $seeker));
        $response->assertStatus(200);
    }

    public function test_cross_company_resume_download_is_forbidden()
    {
        $companyUser1 = User::factory()->create();
        $companyUser1->assignRole('company');
        $company1 = Company::create(['user_id' => $companyUser1->id, 'name' => 'Company 1', 'industry' => 'Tech', 'location' => 'Cairo']);

        $companyUser2 = User::factory()->create();
        $companyUser2->assignRole('company');
        $company2 = Company::create(['user_id' => $companyUser2->id, 'name' => 'Company 2', 'industry' => 'Finance', 'location' => 'Alexandria']);

        $seeker = User::factory()->create();
        $seeker->assignRole('seeker');
        $resume = Resume::create([
            'user_id' => $seeker->id,
            'file_path' => 'cvs/candidate_cv.pdf',
            'original_name' => 'candidate_cv.pdf',
        ]);

        // Seeker applied to Company 1's job only
        $job1 = Job::create(['company_id' => $company1->id, 'title' => 'Developer', 'description' => 'Test', 'requirements' => 'Test', 'type' => 'full-time', 'location' => 'Cairo', 'vacancies' => 1, 'experience_years' => '1']);
        Application::create(['job_posting_id' => $job1->id, 'user_id' => $seeker->id, 'status' => 'pending']);

        // Company 2 attempts to download seeker's CV -> must be forbidden
        $response = $this->actingAs($companyUser2)->get(route('resumes.download', $resume));
        $response->assertStatus(403);
    }

    public function test_invalid_executable_upload_is_rejected()
    {
        Storage::fake('local');
        Storage::fake('public');

        $response = $this->post('/register', [
            'first_name' => 'Malicious',
            'last_name' => 'User',
            'email' => 'hacker@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '01000000000',
            'location' => 'Cairo',
            'religion' => 'Christian',
            'nationality' => 'Egyptian',
            'birth_date' => '2000-01-01',
            'education_status' => 'graduated',
            'education_degree' => 'CS',
            'gender' => 'male',
            'headline' => 'Hacker',
            'employment_status' => 'unemployed',
            'application_date' => '2026-08-09',
            'microsoft_office_skills' => 5,
            'experience_details' => 'None',
            'last_salary' => '0',
            'confession_father' => 'Father',
            'applicant_church' => 'Church',
            'avatar' => UploadedFile::fake()->create('avatar.jpg', 10, 'image/jpeg'),
            'cv' => UploadedFile::fake()->create('exploit.php', 100, 'application/x-php'), // Executable file
        ]);

        $response->assertSessionHasErrors('cv');
    }

    public function test_oversized_cv_upload_is_rejected()
    {
        Storage::fake('local');
        Storage::fake('public');

        $response = $this->post('/register', [
            'first_name' => 'BigFile',
            'last_name' => 'User',
            'email' => 'bigfile@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '01000000000',
            'location' => 'Cairo',
            'religion' => 'Christian',
            'nationality' => 'Egyptian',
            'birth_date' => '2000-01-01',
            'education_status' => 'graduated',
            'education_degree' => 'CS',
            'gender' => 'male',
            'headline' => 'Engineer',
            'employment_status' => 'unemployed',
            'application_date' => '2026-08-09',
            'microsoft_office_skills' => 5,
            'experience_details' => 'None',
            'last_salary' => '0',
            'confession_father' => 'Father',
            'applicant_church' => 'Church',
            'avatar' => UploadedFile::fake()->create('avatar.jpg', 10, 'image/jpeg'),
            'cv' => UploadedFile::fake()->create('big_cv.pdf', 15000, 'application/pdf'), // 15MB (> 10MB)
        ]);

        $response->assertSessionHasErrors('cv');
    }
}
