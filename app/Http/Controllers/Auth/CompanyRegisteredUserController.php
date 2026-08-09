<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class CompanyRegisteredUserController extends Controller
{
    /**
     * Display the company registration view.
     */
    public function create(): View
    {
        return view('auth.company-register');
    }

    /**
     * Handle an incoming company registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'industry' => ['required', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'url', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'first_name' => $request->company_name,
            'last_name' => 'Company', // Default last name
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location' => $request->location,
            // Companies don't need these but they are nullable or we can set defaults
            'application_status' => 'reviewed', // Pre-reviewed or pending?
        ]);

        // Assign 'company' role
        $companyRole = Role::where('name', 'company')->first();
        if ($companyRole) {
            $user->assignRole($companyRole);
        }

        Company::create([
            'user_id' => $user->id,
            'name' => $request->company_name,
            'industry' => $request->industry,
            'linkedin' => $request->linkedin,
            'location' => $request->location,
            'is_verified' => false,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
