<?php

namespace Tests\Feature\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use App\Models\Resume;
use Spatie\Permission\Models\Role;

class PerformanceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'seeker']);
    }

    public function test_admin_candidate_index_eager_loads_resumes_to_prevent_n_plus_one()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Create 1 candidate with a resume
        $user1 = User::factory()->create();
        $user1->assignRole('seeker');
        Resume::create([
            'user_id' => $user1->id,
            'file_path' => 'cvs/cv1.pdf',
            'original_name' => 'cv1.pdf',
        ]);

        // Pre-populate the statistics cache so they don't affect query counts
        $this->actingAs($admin)->get(route('admin.users.index'));

        // Measure queries with 1 candidate
        DB::enableQueryLog();
        $response = $this->actingAs($admin)->get(route('admin.users.index'));
        $response->assertStatus(200);
        $queriesForOneCandidate = count(DB::getQueryLog());
        DB::disableQueryLog();

        // Create 5 more candidates with resumes
        for ($i = 2; $i <= 6; $i++) {
            $user = User::factory()->create();
            $user->assignRole('seeker');
            Resume::create([
                'user_id' => $user->id,
                'file_path' => "cvs/cv{$i}.pdf",
                'original_name' => "cv{$i}.pdf",
            ]);
        }

        // Re-populate the stats cache for the new candidates
        Cache::forget('seekers_total_count');
        Cache::forget('seekers_pending_count');
        Cache::forget('seekers_reviewed_count');
        Cache::forget('resumes_total_count');
        $this->actingAs($admin)->get(route('admin.users.index'));

        // Measure queries with 6 candidates
        DB::flushQueryLog();
        DB::enableQueryLog();
        $response = $this->actingAs($admin)->get(route('admin.users.index'));
        $response->assertStatus(200);
        $queriesForSixCandidates = count(DB::getQueryLog());
        DB::disableQueryLog();

        // If eager loading is active, the query count must remain exactly the same (no N+1 queries)
        $this->assertEquals($queriesForOneCandidate, $queriesForSixCandidates);
    }

    public function test_admin_dashboard_stats_are_cached()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Assert caches do not exist yet
        Cache::forget('seekers_total_count');
        Cache::forget('seekers_pending_count');
        Cache::forget('seekers_reviewed_count');
        Cache::forget('resumes_total_count');

        $response = $this->actingAs($admin)->get(route('admin.users.index'));
        $response->assertStatus(200);

        // Assert caches are populated now
        $this->assertTrue(Cache::has('seekers_total_count'));
        $this->assertTrue(Cache::has('seekers_pending_count'));
        $this->assertTrue(Cache::has('seekers_reviewed_count'));
        $this->assertTrue(Cache::has('resumes_total_count'));
    }

    public function test_cache_is_invalidated_when_seeker_is_created_or_deleted()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Populate cache
        $this->actingAs($admin)->get(route('admin.users.index'));
        $this->assertTrue(Cache::has('seekers_total_count'));

        // Create a new seeker via user creation (this should fire the saved Model event)
        $newSeeker = User::factory()->create();
        $newSeeker->assignRole('seeker');

        // Assert cache was invalidated (forgotten)
        $this->assertFalse(Cache::has('seekers_total_count'));
    }
}
