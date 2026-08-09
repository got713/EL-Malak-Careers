<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('company')->latest()->paginate(15);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $job->load(['company', 'applications.user.resumes', 'applications.user.userSkills.skill']);
        return view('admin.jobs.show', compact('job'));
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', __('Job deleted successfully.'));
    }

    public function nominate(Job $job)
    {
        $job->load('company');
        
        // Exclude users who are already nominated/applied for this job
        $existingApplicantIds = $job->applications()->pluck('user_id')->toArray();
        
        $seekers = User::role('seeker')
                        ->where('application_status', 'reviewed')
                        ->whereNotIn('id', $existingApplicantIds)
                        ->with(['resumes', 'userSkills.skill'])
                        ->latest()
                        ->get();

        // Calculate Smart Match Score for each candidate
        $jobTitleLower = mb_strtolower($job->title, 'UTF-8');
        $jobReqsLower = mb_strtolower($job->requirements . ' ' . $job->description, 'UTF-8');
        $jobLocLower = mb_strtolower($job->location ?? '', 'UTF-8');

        foreach ($seekers as $seeker) {
            $score = 50; // Base score for reviewed candidates

            // Headline / Target Job title match (up to +25)
            if ($seeker->headline) {
                $headlineLower = mb_strtolower($seeker->headline, 'UTF-8');
                if (str_contains($jobTitleLower, $headlineLower) || str_contains($headlineLower, $jobTitleLower)) {
                    $score += 25;
                } else {
                    $words = array_filter(explode(' ', $headlineLower), fn($w) => mb_strlen($w, 'UTF-8') > 2);
                    foreach ($words as $word) {
                        if (str_contains($jobTitleLower, $word)) {
                            $score += 12;
                            break;
                        }
                    }
                }
            }

            // Location match (up to +15)
            if ($seeker->location && $jobLocLower) {
                $seekerLocLower = mb_strtolower($seeker->location, 'UTF-8');
                if (str_contains($jobLocLower, $seekerLocLower) || str_contains($seekerLocLower, $jobLocLower)) {
                    $score += 15;
                }
            }

            // Experience match (up to +10)
            if ($seeker->years_of_experience && $seeker->years_of_experience !== '0') {
                $score += 10;
            }

            $seeker->match_score = min(99, max(45, $score));
        }

        // Sort seekers by match_score descending
        $seekers = $seekers->sortByDesc('match_score')->values();

        return view('admin.jobs.nominate', compact('job', 'seekers'));
    }

    public function storeNominations(Request $request, Job $job)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $nominatedCount = 0;
        foreach ($request->user_ids as $userId) {
            $user = User::find($userId);
            if ($user && $user->hasRole('seeker')) {
                // Check if already applied to prevent duplicates
                $exists = Application::where('job_posting_id', $job->id)
                                     ->where('user_id', $user->id)
                                     ->exists();
                if (!$exists) {
                    $resume = $user->resumes()->latest()->first();
                    
                    Application::create([
                        'job_posting_id' => $job->id,
                        'user_id' => $user->id,
                        'resume_id' => $resume ? $resume->id : null,
                        'status' => 'pending',
                        'applied_at' => now(),
                    ]);
                    $nominatedCount++;
                }
            }
        }

        if ($nominatedCount > 0 && $job->company && $job->company->user) {
            $job->company->user->notify(new \App\Notifications\NewNominationNotification($job->id, $job->title, $nominatedCount));
        }

        return redirect()->route('admin.jobs.show', $job)->with('success', __('Candidates nominated successfully and sent to the company!'));
    }
}
