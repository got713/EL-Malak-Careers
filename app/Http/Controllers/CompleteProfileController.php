<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resume;

class CompleteProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        if (!$user->google_id) {
            return redirect()->route('dashboard');
        }

        $isIncomplete = empty($user->phone)
            || empty($user->gender)
            || empty($user->birth_date)
            || empty($user->nationality)
            || empty($user->education_degree)
            || is_null($user->years_of_experience)
            || !$user->resumes()->exists();

        if (!$isIncomplete) {
            return redirect()->route('dashboard');
        }

        return view('auth.complete-profile', ['user' => $user]);
    }

    public function save(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name'          => ['required', 'string', 'max:255'],
            'last_name'           => ['required', 'string', 'max:255'],
            'phone'               => ['required', 'string', 'max:20'],
            'gender'              => ['required', 'in:male,female'],
            'birth_date'          => ['required', 'date', 'before:-16 years'],
            'nationality'         => ['required', 'string', 'max:100'],
            'religion'            => ['nullable', 'string', 'max:100'],
            'location'            => ['nullable', 'string', 'max:255'],
            'education_status'    => ['required', 'in:studying,graduated'],
            'education_degree'    => ['required', 'string', 'max:255'],
            'years_of_experience' => ['required', 'string', 'max:50'],
            'worker_type'         => ['nullable', 'in:white_collar,blue_collar'],
            'headline'            => ['nullable', 'string', 'max:255'],
            'linkedin_url'        => ['nullable', 'url', 'max:255'],
            'cv'                  => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'confession_father'   => ['nullable', 'string', 'max:255'],
            'applicant_church'    => ['nullable', 'string', 'max:255'],
            'recommendation_letter' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:10240'],
        ]);

        if ($request->hasFile('recommendation_letter')) {
            $user->recommendation_letter = $request->file('recommendation_letter')->store('recommendations', 'local');
        }

        // Save core profile data (no cv or recommendation_letter in fillable)
        $user->fill(collect($validated)->except(['cv', 'cv_description', 'recommendation_letter'])->toArray());

        // Assign seeker role if not already set
        if (!$user->hasAnyRole(['admin', 'company', 'seeker'])) {
            $user->assignRole('seeker');
        }

        $user->save();

        // Handle CV upload
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $path = $file->store('cvs', 'local');

            Resume::create([
                'user_id'       => $user->id,
                'file_path'     => $path,
                'original_name' => $file->getClientOriginalName(),
                'is_primary'    => true,
                'description'   => $request->cv_description,
            ]);
        }

        return redirect()->route('dashboard')->with('status', 'profile-completed');
    }
}
