<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="glass-panel overflow-hidden p-8 relative group animate-fade-in-up">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-sky-500/10 opacity-0 group-hover:opacity-100 transition duration-700"></div>
                <div class="relative z-10 flex items-center">
                    <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-2xl font-bold shadow-sm mr-6">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ __('Welcome back, ') }}{{ auth()->user()->name }}!</h3>
                        <p class="text-slate-500 dark:text-slate-400 mt-1">
                            @role('admin')
                                {{ __('You are an Administrator. You can view all registered users.') }}
                            @elserole('company')
                                @if(auth()->user()->company && !auth()->user()->company->is_verified)
                                    <span class="text-rose-500 font-bold flex items-center gap-2">
                                        <span class="w-3.5 h-3.5 rounded-full bg-rose-500 animate-pulse"></span>
                                        {{ __('Your company account is pending review and approval by the administration team. You will be able to post jobs once approved.') }}
                                    </span>
                                @else
                                    {{ __('You are a Company. You can post new job requirements and view your postings.') }}
                                @endif
                            @else
                                @if(auth()->user()->application_status === 'pending')
                                    <span class="text-amber-500 dark:text-amber-400 font-medium">{{ __('Your request is pending review by the administration team.') }}</span>
                                @else
                                    <span class="text-emerald-500 dark:text-emerald-400 font-normal">{{ __('Your application has been reviewed and our team will contact you soon.') }}</span>
                                @endif
                            @endrole
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @role('admin')
                    <!-- Stat Cards -->
                    <div class="lg:col-span-3 grid grid-cols-2 lg:grid-cols-5 gap-6 mb-2">
                        <div class="glass-panel p-6 flex items-center justify-between border-indigo-500/30">
                            <div>
                                <p class="text-sm font-medium text-slate-400">{{ __('New Users (This Month)') }}</p>
                                <p class="text-3xl font-bold text-white mt-1">{{ $stats['new_users_this_month'] ?? 0 }}</p>
                            </div>
                            <div class="bg-indigo-500/20 p-3 rounded-lg text-indigo-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                        </div>
                        <div class="glass-panel p-6 flex items-center justify-between border-emerald-500/30">
                            <div>
                                <p class="text-sm font-medium text-slate-400">{{ __('Active Jobs') }}</p>
                                <p class="text-3xl font-bold text-white mt-1">{{ $stats['active_jobs'] ?? 0 }}</p>
                            </div>
                            <div class="bg-emerald-500/20 p-3 rounded-lg text-emerald-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></div>
                        </div>
                        <div class="glass-panel p-6 flex items-center justify-between border-sky-500/30">
                            <div>
                                <p class="text-sm font-medium text-slate-400">{{ __('Total Companies') }}</p>
                                <p class="text-3xl font-bold text-white mt-1">{{ $stats['total_companies'] ?? 0 }}</p>
                            </div>
                            <div class="bg-sky-500/20 p-3 rounded-lg text-sky-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></div>
                        </div>
                        <div class="glass-panel p-6 flex items-center justify-between {{ ($stats['pending_companies_count'] ?? 0) > 0 ? 'border-rose-500/50 shadow-[0_0_15px_rgba(244,63,94,0.15)]' : 'border-rose-500/30' }}">
                            <div>
                                <p class="text-sm font-medium text-slate-400">{{ __('Pending Companies') }}</p>
                                <p class="text-3xl font-bold {{ ($stats['pending_companies_count'] ?? 0) > 0 ? 'text-rose-400 font-black animate-pulse' : 'text-white' }} mt-1">{{ $stats['pending_companies_count'] ?? 0 }}</p>
                            </div>
                            <div class="bg-rose-500/20 p-3 rounded-lg text-rose-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                        </div>
                        <div class="glass-panel p-6 flex items-center justify-between border-amber-500/30">
                            <div>
                                <p class="text-sm font-medium text-slate-400">{{ __('Total Candidates') }}</p>
                                <p class="text-3xl font-bold text-white mt-1">{{ $stats['total_users'] ?? 0 }}</p>
                            </div>
                            <div class="bg-amber-500/20 p-3 rounded-lg text-amber-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="lg:col-span-2 glass-panel p-6">
                        <h4 class="text-lg font-bold text-white mb-4">{{ __('User Registrations (Last 7 Days)') }}</h4>
                        <div class="relative h-72">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>
                    <div class="lg:col-span-1 glass-panel p-6">
                        <h4 class="text-lg font-bold text-white mb-4">{{ __('Top Hiring Companies') }}</h4>
                        <div class="relative h-72">
                            <canvas id="companiesChart"></canvas>
                        </div>
                    </div>

                    <!-- Admin View Users -->
                    <a href="{{ route('admin.users.index') }}" class="glass-panel p-6 flex flex-col justify-center items-center text-center group lg:col-span-3">
                        <div class="bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 p-3 rounded-full mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ __('View Candidates / Advanced Search') }}</h4>
                        <span class="text-sm font-medium text-indigo-600 dark:text-indigo-400">{!! __('Filter by Religion, Location & Status &rarr;') !!}</span>
                    </a>

                    <!-- Pending Company Approvals Table -->
                    @if($pendingCompanies->isNotEmpty())
                    <div class="lg:col-span-3 glass-panel p-6 mt-6">
                        <h4 class="text-lg font-bold text-rose-400 mb-4 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-pulse"></span>
                            {{ __('Pending Company Approvals') }}
                        </h4>
                        <div class="overflow-x-auto">
                            <table class="w-full ltr:text-left rtl:text-right border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-700/50 text-slate-400 bg-slate-800/30 text-xs">
                                        <th class="p-3 font-semibold">{{ __('Company Name') }}</th>
                                        <th class="p-3 font-semibold">{{ __('Industry') }}</th>
                                        <th class="p-3 font-semibold">{{ __('Location') }}</th>
                                        <th class="p-3 font-semibold">{{ __('Register Date') }}</th>
                                        <th class="p-3 font-semibold text-center">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800 text-sm">
                                    @foreach($pendingCompanies as $company)
                                    <tr class="hover:bg-slate-800/30 transition">
                                        <td class="p-3 font-medium text-white">{{ $company->name }}</td>
                                        <td class="p-3 text-slate-300">{{ $company->industry }}</td>
                                        <td class="p-3 text-slate-300">{{ $company->location }}</td>
                                        <td class="p-3 text-slate-400">{{ $company->created_at->format('M d, Y') }}</td>
                                        <td class="p-3 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <form action="{{ route('admin.companies.verify', $company) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                                        {{ __('Approve') }}
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.companies.index') }}" class="text-xs text-indigo-400 hover:underline">
                                                    {{ __('Details') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                @elserole('company')
                    <!-- Company Post Job -->
                    @if(auth()->user()->company && !auth()->user()->company->is_verified)
                        <div class="glass-panel p-6 flex flex-col justify-center items-center text-center opacity-50 cursor-not-allowed border-rose-500/30">
                            <div class="bg-slate-800/80 text-slate-500 p-3 rounded-full mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <h4 class="text-lg font-bold text-slate-500 mb-2">{{ __('Post New Requirement (Locked)') }}</h4>
                            <span class="text-xs text-rose-500 font-bold uppercase tracking-wider">{{ __('Pending Account Approval') }}</span>
                        </div>
                    @else
                        <a href="{{ route('company.jobs.create') }}" class="glass-panel p-6 flex flex-col justify-center items-center text-center group">
                            <div class="bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 p-3 rounded-full mb-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ __('Post New Requirement') }}</h4>
                            <span class="text-sm font-medium text-emerald-600 dark:text-emerald-400">{!! __('Add Job Details &rarr;') !!}</span>
                        </a>
                    @endif
                    
                    <!-- Company View Jobs -->
                    <a href="{{ route('company.jobs.index') }}" class="glass-panel p-6 flex flex-col justify-center items-center text-center group">
                        <div class="bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 p-3 rounded-full mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ __('My Requirements') }}</h4>
                        <span class="text-sm font-medium text-sky-600 dark:text-sky-400">{!! __('View posted jobs &rarr;') !!}</span>
                    </a>
                @else
                    <!-- Job Seeker: Professional Summary Card -->
                    <div class="glass-panel p-6 md:col-span-2 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                    {{ __('Professional Summary') }}
                                </h4>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-100 dark:border-slate-700/50">
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-1 font-semibold uppercase tracking-wider">{{ __('Target Headline') }}</p>
                                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">{{ auth()->user()->headline ?: __('Not Specified') }}</p>
                                </div>
                                <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-100 dark:border-slate-700/50">
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-1 font-semibold uppercase tracking-wider">{{ __('Experience') }}</p>
                                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                        @if(is_numeric(auth()->user()->years_of_experience))
                                            @if(auth()->user()->years_of_experience == 0)
                                                {{ __('Fresh Graduate / No Experience') }}
                                            @else
                                                {{ auth()->user()->years_of_experience }} {{ __('Years') }}
                                            @endif
                                        @elseif(auth()->user()->years_of_experience == '0')
                                            {{ __('Fresh Graduate / No Experience') }}
                                        @elseif(auth()->user()->years_of_experience == '1-3')
                                            {{ __('1 to 3 Years') }}
                                        @elseif(auth()->user()->years_of_experience == '3-5')
                                            {{ __('3 to 5 Years') }}
                                        @elseif(auth()->user()->years_of_experience == '5+')
                                            {{ __('More than 5 Years') }}
                                        @elseif(auth()->user()->years_of_experience)
                                            {{ auth()->user()->years_of_experience }}
                                        @else
                                            {{ __('Not Specified') }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="mb-2">
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-2 font-semibold uppercase tracking-wider">{{ __('Skills') }}</p>
                                <div class="flex flex-wrap gap-2">
                                    @php $userSkills = auth()->user()->userSkills()->with('skill')->get(); @endphp
                                    @forelse($userSkills as $userSkill)
                                        <span class="px-3 py-1 bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400 text-xs font-bold rounded-full border border-teal-200 dark:border-teal-500/20">
                                            {{ $userSkill->skill->name }}
                                        </span>
                                    @empty
                                        <span class="text-sm text-slate-400">{{ __('No skills added yet.') }}</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Seeker: CV Card -->
                    <div class="glass-panel p-6 flex flex-col justify-between">
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-6">
                                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                {{ __('My Resume') }}
                            </h4>
                            
                            @php $resume = auth()->user()->resumes()->latest()->first(); @endphp
                            @if($resume)
                                <div class="bg-indigo-50 dark:bg-indigo-500/10 p-5 rounded-xl border border-indigo-100 dark:border-indigo-500/20 text-center mb-6">
                                    <svg class="w-12 h-12 text-indigo-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    <p class="text-sm font-bold text-indigo-900 dark:text-indigo-300 truncate px-2" title="{{ $resume->original_name }}">{{ $resume->original_name }}</p>
                                    <p class="text-xs text-indigo-600/70 dark:text-indigo-400/70 mt-1">{{ $resume->created_at->diffForHumans() }}</p>
                                </div>
                                <a href="{{ route('resumes.download', $resume) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-all shadow-md hover:shadow-indigo-500/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    {{ __('Download CV') }}
                                </a>
                            @else
                                <div class="text-center py-8">
                                    <span class="text-sm text-slate-400">{{ __('No CV uploaded.') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Edit Profile -->
                    <a href="{{ route('profile.edit') }}" class="glass-panel p-6 flex flex-col justify-center items-center text-center group md:col-span-3">
                        <div class="bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 p-3 rounded-full mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ __('Edit My Profile') }}</h4>
                        <span class="text-sm font-medium text-blue-600 dark:text-blue-400">{!! __('Update your details &rarr;') !!}</span>
                    </a>
                @endrole
            </div>

        </div>
    </div>

    @role('admin')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Users Line Chart
            const ctxUsers = document.getElementById('usersChart').getContext('2d');
            new Chart(ctxUsers, {
                type: 'line',
                data: {
                    labels: {!! isset($chartData['dates']) ? json_encode($chartData['dates']) : '[]' !!},
                    datasets: [{
                        label: 'New Users',
                        data: {!! isset($chartData['users_count']) ? json_encode($chartData['users_count']) : '[]' !!},
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#6366f1',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255, 255, 255, 0.1)' }, ticks: { color: '#94a3b8', stepSize: 1 } },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                    }
                }
            });

            // Companies Doughnut Chart
            const ctxCompanies = document.getElementById('companiesChart').getContext('2d');
            new Chart(ctxCompanies, {
                type: 'doughnut',
                data: {
                    labels: {!! isset($chartData['company_names']) ? json_encode($chartData['company_names']) : '[]' !!},
                    datasets: [{
                        data: {!! isset($chartData['company_jobs_count']) ? json_encode($chartData['company_jobs_count']) : '[]' !!},
                        backgroundColor: ['#6366f1', '#10b981', '#0ea5e9', '#f59e0b', '#ec4899'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { color: '#94a3b8', padding: 20 } }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
    @endrole
</x-app-layout>
