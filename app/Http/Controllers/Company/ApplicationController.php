<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\CompanyFeedbackNotification;

class ApplicationController extends Controller
{
    public function updateStatus(Request $request, Application $application)
    {
        // Ensure the company owns the job posting
        if ($application->job->company_id !== auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected'
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
}
