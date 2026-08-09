<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Models\Resume;
use App\Models\Skill;
use App\Models\UserSkill;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'location' => ['required', 'string', 'max:255'],
            'religion' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', 'before_or_equal:-18 years'],
            'education_status' => ['required', 'in:studying,graduated'],
            'education_degree' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'headline' => ['required', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'years_of_experience' => ['nullable', 'string', 'max:50'],
            'worker_type'         => ['nullable', 'in:white_collar,blue_collar'],
            'skills' => ['nullable', 'string', 'max:500'],
            'cv' => ['required', 'file', 'mimes:pdf', 'max:10240'], // Max 10MB, PDF only
            'cv_description' => ['nullable', 'string', 'max:1000'],
            'recommendation_letter' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:10240'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
            'confession_father' => ['required', 'string', 'max:255'],
            'applicant_church' => ['required', 'string', 'max:255'],
            'current_company' => ['nullable', 'string', 'max:255'],
            'employment_status' => ['required', 'string', 'in:employed,unemployed,other'],
            'application_date' => ['required', 'date'],
            'languages' => ['nullable', 'array'],
            'microsoft_office_skills' => ['required', 'integer', 'min:1', 'max:5'],
            'experience_details' => ['required', 'string'],
            'last_salary' => ['required', 'string', 'max:255'],
        ], [
            'birth_date.before_or_equal' => 'You must be at least 18 years old to register.'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'location' => $request->location,
            'religion' => $request->religion,
            'nationality' => $request->nationality,
            'birth_date' => $request->birth_date,
            'education_status' => $request->education_status,
            'education_degree' => $request->education_degree,
            'gender' => $request->gender,
            'headline' => $request->headline,
            'linkedin_url' => $request->linkedin_url,
            'years_of_experience' => $request->years_of_experience,
            'worker_type'         => $request->worker_type,
            'confession_father' => $request->confession_father,
            'applicant_church' => $request->applicant_church,
            'current_company' => $request->current_company,
            'employment_status' => $request->employment_status,
            'application_date' => $request->application_date,
            'languages' => $request->languages,
            'microsoft_office_skills' => $request->microsoft_office_skills,
            'experience_details' => $request->experience_details,
            'last_salary' => $request->last_salary,
        ]);

        if ($request->hasFile('recommendation_letter')) {
            $user->recommendation_letter = $request->file('recommendation_letter')->store('recommendations', 'local');
            $user->save();
        }

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
            $user->save();
        }

        // Assign 'seeker' role
        $seekerRole = Role::where('name', 'seeker')->first();
        if ($seekerRole) {
            $user->assignRole($seekerRole);
        }

        // Handle CV Upload
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $path = $file->store('cvs', 'local'); // Store securely in private local disk

            Resume::create([
                'user_id' => $user->id,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'is_primary' => true,
                'description' => $request->cv_description,
            ]);
        }

        // Process Skills
        if ($request->filled('skills')) {
            $skillsArray = array_map('trim', explode(',', $request->skills));
            foreach ($skillsArray as $skillName) {
                if (!empty($skillName)) {
                    $skill = Skill::firstOrCreate(['name' => $skillName]);
                    UserSkill::create([
                        'user_id' => $user->id,
                        'skill_id' => $skill->id,
                        'years_experience' => 0 // Default
                    ]);
                }
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
