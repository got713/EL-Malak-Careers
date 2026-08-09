<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileComplete
{
    /**
     * Routes that are allowed even if profile is incomplete.
     */
    protected array $except = [
        'profile.complete',
        'profile.complete.save',
        'logout',
        'lang.switch',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->google_id && !$user->hasRole('admin') && !$user->hasRole('company')) {
            // Check if essential seeker profile fields are missing
            $isIncomplete = empty($user->phone)
                || empty($user->gender)
                || empty($user->birth_date)
                || empty($user->nationality)
                || empty($user->education_degree)
                || is_null($user->years_of_experience)
                || !$user->resumes()->exists();

            if ($isIncomplete) {
                // Allow the complete-profile routes through
                if ($request->routeIs(...$this->except)) {
                    return $next($request);
                }

                return redirect()->route('profile.complete');
            }
        }

        return $next($request);
    }
}
