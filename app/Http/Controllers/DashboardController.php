<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $stats = [];
        $chartData = [];

        if ($user->hasRole('admin')) {
            $stats['total_users'] = User::role('seeker')->count();
            $stats['new_users_this_month'] = User::role('seeker')->whereMonth('created_at', Carbon::now()->month)->count();
            $stats['total_jobs'] = Job::count();
            $stats['active_jobs'] = Job::where('status', 'open')->count();
            $stats['total_companies'] = Company::count();

            // Last 7 days user registrations
            $dates = collect();
            $usersCount = collect();
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->format('Y-m-d');
                $dates->push(Carbon::now()->subDays($i)->format('M d'));
                $usersCount->push(User::role('seeker')->whereDate('created_at', $date)->count());
            }
            
            $chartData['dates'] = $dates;
            $chartData['users_count'] = $usersCount;

            // Top companies by jobs
            $topCompanies = Company::withCount('jobs')->orderBy('jobs_count', 'desc')->take(5)->get();
            $chartData['company_names'] = $topCompanies->pluck('name');
            $chartData['company_jobs_count'] = $topCompanies->pluck('jobs_count');
        }

        return view('dashboard', compact('stats', 'chartData'));
    }
}
