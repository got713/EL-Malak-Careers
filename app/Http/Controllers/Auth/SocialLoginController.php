<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->user();

            $user = \App\Models\User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (!$user) {
                // New user — create and redirect to complete profile
                $user = \App\Models\User::create([
                    'first_name'  => explode(' ', $googleUser->getName())[0] ?? $googleUser->getName(),
                    'last_name'   => explode(' ', $googleUser->getName())[1] ?? '',
                    'email'       => $googleUser->getEmail(),
                    'password'    => bcrypt(\Illuminate\Support\Str::random(16)),
                    'google_id'   => $googleUser->getId(),
                    'google_token'=> $googleUser->token,
                    'email_verified_at' => now(), // Google emails are verified
                ]);

                \Illuminate\Support\Facades\Auth::login($user);

                // Redirect directly to complete-profile for new Google users
                return redirect()->route('profile.complete');
            }

            // Existing user — update tokens
            $user->update([
                'google_id'    => $googleUser->getId(),
                'google_token' => $googleUser->token,
            ]);

            \Illuminate\Support\Facades\Auth::login($user);

            // Check if profile is still incomplete (e.g. existing user with missing data)
            $isIncomplete = !$user->hasRole('admin')
                && !$user->hasRole('company')
                && (
                    empty($user->phone)
                    || empty($user->gender)
                    || empty($user->birth_date)
                    || empty($user->nationality)
                    || empty($user->education_degree)
                    || is_null($user->years_of_experience)
                );

            if ($isIncomplete) {
                return redirect()->route('profile.complete');
            }

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Google OAuth Login Error: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return redirect()->route('login')->withErrors(['email' => __('Unable to login with Google. Please try again.')]);
        }
    }
}

