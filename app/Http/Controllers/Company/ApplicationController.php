<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Interview;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\CompanyFeedbackNotification;
use App\Notifications\InterviewScheduledNotification;

class ApplicationController extends Controller
{
    public function updateStatus(Request $request, Application $application)
    {
        // Ensure the company owns the job posting
        if ($application->job->company_id !== auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }

        // "interview" requires scheduling details and is only ever set via
        // scheduleInterview() below, never through this quick-status form.
        $request->validate([
            'status' => 'required|in:pending,shortlisted,accepted,rejected'
        ]);

        $application->update(['status' => $request->status]);

        // Broadcast the update instantly via WebSockets
        broadcast(new \App\Events\ApplicationStatusUpdated($application->id, $request->status, $application->job_posting_id));

        // Find admins and notify them
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new CompanyFeedbackNotification(
                $application->job_posting_id,
                auth()->user()->company->name,
                $application->user->name,
                $request->status
            ));
        }

        return back()->with('success', __('Candidate status updated successfully.'));
    }

    /**
     * Schedule (or reschedule) an interview for a candidate: sets the date/time,
     * whether it's online or in-person, and the location/meeting link, then
     * moves the application to "interview" status and emails the candidate.
     */
    public function scheduleInterview(Request $request, Application $application)
    {
        // Ensure the company owns the job posting
        if ($application->job->company_id !== auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'interview_date' => ['required', 'date', 'after_or_equal:today'],
            'interview_time' => ['required', 'date_format:H:i'],
            'type' => ['required', 'in:online,in-person'],
            'location_link' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $scheduledAt = \Illuminate\Support\Carbon::parse($validated['interview_date'].' '.$validated['interview_time']);

        $interview = Interview::updateOrCreate(
            ['application_id' => $application->id],
            [
                'scheduled_at' => $scheduledAt,
                'type' => $validated['type'],
                'location_link' => $validated['location_link'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'scheduled',
            ]
        );

        $application->update(['status' => 'interview']);

        broadcast(new \App\Events\ApplicationStatusUpdated($application->id, 'interview', $application->job_posting_id));

        // Email + in-app notification to the candidate
        $application->user->notify(new InterviewScheduledNotification(
            $interview,
            $application->job->title,
            auth()->user()->company->name
        ));

        // Let admins know too, so they can follow up with the company/candidate
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new CompanyFeedbackNotification(
                $application->job_posting_id,
                auth()->user()->company->name,
                $application->user->name,
                'interview'
            ));
        }

        return back()->with('success', __('Interview scheduled and the candidate has been notified by email.'));
    }
}
