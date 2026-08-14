<?php

namespace Tests\Feature\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Job;
use App\Models\Company;
use App\Models\Application;
use Spatie\Permission\Models\Role;

class ComprehensiveSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'company']);
        Role::create(['name' => 'seeker']);
    }

    public function test_login_rate_limiting_is_enforced()
    {
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/login', [
                'email' => 'wrong@example.com',
                'password' => 'wrongpassword',
            ]);
            $this->assertNotEquals(429, $response->getStatusCode());
        }

        // 6th attempt should hit rate limit (throttle:5,1)
        $response = $this->post('/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);
        $response->assertStatus(429);
    }

    public function test_forgot_password_rate_limiting_is_enforced()
    {
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/forgot-password', [
                'email' => 'user@example.com',
            ]);
            $this->assertNotEquals(429, $response->getStatusCode());
        }

        // 6th attempt should hit rate limit (throttle:5,1)
        $response = $this->post('/forgot-password', [
            'email' => 'user@example.com',
        ]);
        $response->assertStatus(429);
    }

    public function test_normal_seeker_cannot_access_admin_routes()
    {
        $seeker = User::factory()->create();
        $seeker->assignRole('seeker');

        $response = $this->actingAs($seeker)->get('/admin/users');
        $response->assertStatus(403);
    }

    public function test_company_user_cannot_access_admin_routes()
    {
        $companyUser = User::factory()->create();
        $companyUser->assignRole('company');

        $response = $this->actingAs($companyUser)->get('/admin/users');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_routes()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
    }

    public function test_company_cannot_edit_another_company_job()
    {
        $user1 = User::factory()->create();
        $user1->assignRole('company');
        $company1 = Company::create(['user_id' => $user1->id, 'name' => 'Comp 1', 'industry' => 'Tech', 'location' => 'Cairo']);
        $company1->forceFill(['is_verified' => true])->save();
        $job1 = Job::create(['company_id' => $company1->id, 'title' => 'Dev 1', 'description' => 'Desc', 'requirements' => 'Req', 'type' => 'full-time', 'location' => 'Cairo', 'vacancies' => 1, 'experience_years' => '1']);

        $user2 = User::factory()->create();
        $user2->assignRole('company');
        $company2 = Company::create(['user_id' => $user2->id, 'name' => 'Comp 2', 'industry' => 'Finance', 'location' => 'Alex']);
        $company2->forceFill(['is_verified' => true])->save();

        // Company 2 attempts to edit Company 1's job
        $response = $this->actingAs($user2)->get(route('company.jobs.edit', $job1));
        $response->assertStatus(403);

        // Company 2 attempts to update Company 1's job
        $updateResponse = $this->actingAs($user2)->put(route('company.jobs.update', $job1), [
            'title' => 'Hacked Title',
            'description' => 'Hacked Desc',
            'requirements' => 'Hacked Req',
            'type' => 'full-time',
            'location' => 'Cairo',
            'vacancies' => 5,
            'experience_years' => '5',
        ]);
        $updateResponse->assertStatus(403);
    }

    public function test_company_cannot_update_application_status_of_another_company_job()
    {
        $user1 = User::factory()->create();
        $user1->assignRole('company');
        $company1 = Company::create(['user_id' => $user1->id, 'name' => 'Comp 1', 'industry' => 'Tech', 'location' => 'Cairo']);
        $company1->forceFill(['is_verified' => true])->save();
        $job1 = Job::create(['company_id' => $company1->id, 'title' => 'Dev 1', 'description' => 'Desc', 'requirements' => 'Req', 'type' => 'full-time', 'location' => 'Cairo', 'vacancies' => 1, 'experience_years' => '1']);

        $seeker = User::factory()->create();
        $application = Application::create(['job_posting_id' => $job1->id, 'user_id' => $seeker->id, 'status' => 'pending']);

        $user2 = User::factory()->create();
        $user2->assignRole('company');
        $company2 = Company::create(['user_id' => $user2->id, 'name' => 'Comp 2', 'industry' => 'Finance', 'location' => 'Alex']);
        $company2->forceFill(['is_verified' => true])->save();

        $response = $this->actingAs($user2)->patch(route('company.applications.status', $application), [
            'status' => 'accepted',
        ]);
        $response->assertStatus(403);
    }

    public function test_security_headers_are_present_on_web_responses()
    {
        $response = $this->get('/login');

        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('Permissions-Policy');
        $response->assertHeader('Content-Security-Policy');
    }

    public function test_logout_invalidates_authenticated_session()
    {
        $user = User::factory()->create();
        $user->assignRole('seeker');

        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');
        $this->assertGuest();
    }
}
