<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;

class JobController extends Controller
{
    private function checkCompanyVerification()
    {
        $company = auth()->user()->company;
        if (!$company || !$company->is_verified) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                redirect()->route('dashboard')->with('error', __('Your company account is pending approval by the administration team. You will be able to post jobs once approved.'))
            );
        }
    }

    public function index()
    {
        $company = auth()->user()->company;
        $jobs = Job::where('company_id', $company->id)->latest()->paginate(10);
        return view('company.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $this->checkCompanyVerification();
        return view('company.jobs.create');
    }

    public function store(StoreJobRequest $request)
    {
        $this->checkCompanyVerification();
        $company = auth()->user()->company;

        Job::create([
            'company_id' => $company->id,
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'type' => $request->type,
            'location' => $request->location,
            'vacancies' => $request->vacancies,
            'experience_years' => $request->experience_years,
            'salary_range' => $request->salary_range,
            'status' => 'open',
        ]);

        return redirect()->route('company.jobs.index')->with('success', __('Job posted successfully.'));
    }

    public function show(Job $job)
    {
        // Ensure the company owns this job
        if ($job->company_id !== auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }

        $job->load(['applications.user.resumes', 'applications.user.userSkills.skill']);
        return view('company.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        $this->checkCompanyVerification();
        // Ensure the company owns this job
        if ($job->company_id !== auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('company.jobs.edit', compact('job'));
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $this->checkCompanyVerification();
        // Ensure the company owns this job
        if ($job->company_id !== auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'type' => $request->type,
            'location' => $request->location,
            'vacancies' => $request->vacancies,
            'experience_years' => $request->experience_years,
            'salary_range' => $request->salary_range,
        ]);

        return redirect()->route('company.jobs.index')->with('success', __('Job updated successfully.'));
    }
}
