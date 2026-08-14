<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Job Details') }}: {{ $job->title }}
            </h2>
            <div class="flex space-x-4 rtl:space-x-reverse">
                <a href="{{ route('admin.jobs.nominate', $job) }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    {{ __('Nominate Candidates') }}
                </a>
                <a href="{{ route('admin.jobs.index') }}" class="text-slate-400 hover:text-white transition flex items-center">
                    {!! __('&larr; Back to Jobs') !!}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-xl font-bold text-white border-b border-slate-700/50 pb-4 mb-6">{{ __('Job Details') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Job Title') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $job->title }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Company') }}</span>
                        <span class="block text-lg text-white font-medium">{{ optional($job->company)->name }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Employment Type') }}</span>
                        <span class="block text-lg text-white font-medium">{{ ucfirst($job->type) }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Location') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $job->location }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Vacancies') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $job->vacancies }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Years of Experience') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $job->experience_years }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Salary Range') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $job->salary_range ?: __('Not Specified') }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Status') }}</span>
                        <span class="block text-lg text-white font-medium">{{ ucfirst($job->status) }}</span>
                    </div>
                </div>

                <div class="mt-8">
                    <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Job Description') }}</span>
                    <p class="text-slate-300 bg-slate-800/30 p-4 rounded-lg border border-slate-700">{{ $job->description }}</p>
                </div>

                <div class="mt-6">
                    <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Requirements') }}</span>
                    <p class="text-slate-300 bg-slate-800/30 p-4 rounded-lg border border-slate-700">{{ $job->requirements }}</p>
                </div>
            </div>

            @if($job->company)
            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-xl font-bold text-white border-b border-slate-700/50 pb-4 mb-6">{{ __('Company Information') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Company Name') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $job->company->name }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Industry') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $job->company->industry }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('LinkedIn Account') }}</span>
                        @if($job->company->linkedin)
                            <a href="{{ $job->company->linkedin }}" target="_blank" class="text-sky-400 hover:underline block text-lg font-medium">{{ __('View LinkedIn Profile') }}</a>
                        @else
                            <span class="block text-lg text-slate-500 font-medium">{{ __('Not Provided') }}</span>
                        @endif
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Location') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $job->company->location }}</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Nominated Candidates List Area (For Admin) -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-black text-white flex items-center gap-3">
                        <span class="bg-emerald-500 text-white p-2 rounded-lg shadow-lg shadow-emerald-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </span>
                        {{ __('Nominated Candidates') }} ({{ $job->applications->count() }})
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    @forelse($job->applications as $application)
                        @php $candidate = $application->user; @endphp
                        <div id="application-{{ $application->id }}" class="glass-card p-6 flex flex-col xl:flex-row gap-6 items-center hover:-translate-y-1 transition-all duration-300 hover:shadow-[0_10px_30px_rgba(16,185,129,0.15)] group relative overflow-hidden border border-slate-700/50">
                            <!-- Subtle highlight on hover -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-emerald-500/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

                            <!-- Avatar & Name Section -->
                            <div class="flex items-center gap-5 w-full xl:w-1/4 z-10 border-b xl:border-b-0 xl:ltr:border-r xl:rtl:border-l border-slate-700/50 pb-6 xl:pb-0 xl:ltr:pr-6 xl:rtl:pl-6">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center text-2xl font-black shadow-lg shadow-emerald-500/30 transform group-hover:rotate-6 transition-transform">
                                        {{ mb_substr($candidate->first_name, 0, 1) }}
                                    </div>
                                    <div class="absolute -bottom-2 -right-2 bg-indigo-500 w-5 h-5 border-2 border-slate-900 rounded-full" title="Verified"></div>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white group-hover:text-emerald-300 transition-colors">{{ $candidate->name }}</h4>
                                    <p class="text-sm text-teal-400 font-semibold mt-1">{{ $candidate->headline ?: __('Not Specified') }}</p>
                                </div>
                            </div>
                            
                            <!-- Detailed Info Grid -->
                            <div class="flex-grow grid grid-cols-1 md:grid-cols-3 gap-6 w-full z-10">
                                <!-- Status & Email -->
                                <div class="space-y-4">
                                    <div>
                                        <span class="flex items-center text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ __('Company Decision') }}
                                        </span>
                                        <div class="status-container inline-block">
                                            @if($application->status === 'pending')
                                                <span class="text-amber-400 font-bold bg-amber-500/10 px-3 py-1.5 rounded-lg border border-amber-500/20 inline-block text-xs">{{ __('Pending Review') }}</span>
                                            @elseif($application->status === 'accepted')
                                                <span class="text-emerald-400 font-bold bg-emerald-500/10 px-3 py-1.5 rounded-lg border border-emerald-500/20 inline-block text-xs">{{ __('Accepted') }}</span>
                                            @elseif($application->status === 'rejected')
                                                <span class="text-rose-400 font-bold bg-rose-500/10 px-3 py-1.5 rounded-lg border border-rose-500/20 inline-block text-xs">{{ __('Rejected') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <span class="flex items-center text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            {{ __('Email') }}
                                        </span>
                                        <span class="text-slate-200 font-medium truncate max-w-full block" dir="ltr" title="{{ $candidate->email }}">{{ $candidate->email }}</span>
                                    </div>
                                </div>

                                <!-- Exp & Edu -->
                                <div class="space-y-4">
                                    <div>
                                        <span class="flex items-center text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            {{ __('Experience') }}
                                        </span>
                                        <span class="text-slate-200 font-medium bg-slate-800/50 px-3 py-1.5 rounded-lg border border-slate-700/50 inline-block">{{ $candidate->years_of_experience ?: __('Not Specified') }}</span>
                                    </div>
                                    <div>
                                        <span class="flex items-center text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                            {{ __('Education') }}
                                        </span>
                                        <span class="text-slate-200 font-medium bg-slate-800/50 px-3 py-1.5 rounded-lg border border-slate-700/50 inline-block truncate max-w-full" title="{{ $candidate->education_degree }}">{{ $candidate->education_degree ?: __('Not Specified') }}</span>
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="space-y-4">
                                    <div>
                                        <span class="flex items-center text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ __('Location') }}
                                        </span>
                                        <span class="text-slate-200 font-medium">{{ $candidate->location }}</span>
                                    </div>
                                    <div>
                                        <span class="flex items-center text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            {{ __('Phone') }}
                                        </span>
                                        <span class="text-slate-200 font-medium" dir="ltr">{{ $candidate->phone ?: __('Not Specified') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions (CV & Rec Letter) -->
                            <div class="flex flex-col gap-3 w-full xl:w-[220px] z-10 border-t xl:border-t-0 xl:ltr:border-l xl:rtl:border-r border-slate-700/50 pt-6 xl:pt-0 xl:ltr:pl-6 xl:rtl:pr-6">
                                @if($application->resume_id && $candidate->resumes->where('id', $application->resume_id)->first())
                                    <a href="{{ route('resumes.download', $candidate->resumes->where('id', $application->resume_id)->first()) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-slate-600 to-slate-500 hover:from-slate-500 hover:to-slate-400 text-white shadow-[0_4px_15px_rgba(71,85,105,0.3)] hover:shadow-[0_6px_20px_rgba(71,85,105,0.4)] px-5 py-2.5 rounded-xl text-sm font-bold transition-all transform hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        {{ __('View CV') }}
                                    </a>
                                @elseif($candidate->resumes->count() > 0)
                                    <a href="{{ route('resumes.download', $candidate->resumes->sortByDesc('created_at')->first()) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-slate-600 to-slate-500 hover:from-slate-500 hover:to-slate-400 text-white shadow-[0_4px_15px_rgba(71,85,105,0.3)] hover:shadow-[0_6px_20px_rgba(71,85,105,0.4)] px-5 py-2.5 rounded-xl text-sm font-bold transition-all transform hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        {{ __('View CV') }}
                                    </a>
                                @endif
                                
                                @if(auth()->user()?->hasRole('admin') && $candidate->recommendation_letter)
                                    <a href="{{ route('users.recommendation.download', $candidate) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-amber-500/10 hover:bg-amber-500/20 text-amber-500 border border-amber-500/30 px-5 py-2.5 rounded-xl text-sm font-bold transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 01-2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        {{ __('Recommendation Letter') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="glass-card p-12 text-center border-dashed border-2 border-slate-700/50">
                            <h4 class="text-xl font-bold text-slate-400 mb-2">{{ __('No candidates nominated yet') }}</h4>
                            <p class="text-slate-500">{{ __('Click "Nominate Candidates" to assign seekers to this job.') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script type="module">
        if (window.Echo) {
            window.Echo.channel('job.{{ $job->id }}')
                .listen('.ApplicationStatusUpdated', (e) => {
                    // e.applicationId, e.status, e.jobId
                    const appDiv = document.querySelector(`#application-${e.applicationId}`);
                    if (appDiv) {
                        const statusContainer = appDiv.querySelector('.status-container');
                        if (statusContainer) {
                            let newHtml = '';
                            if (e.status === 'accepted') {
                                newHtml = `<span class="text-emerald-400 font-bold bg-emerald-500/10 px-3 py-1.5 rounded-lg border border-emerald-500/20 inline-block text-xs">{{ __('Accepted') }}</span>`;
                            } else if (e.status === 'rejected') {
                                newHtml = `<span class="text-rose-400 font-bold bg-rose-500/10 px-3 py-1.5 rounded-lg border border-rose-500/20 inline-block text-xs">{{ __('Rejected') }}</span>`;
                            } else {
                                newHtml = `<span class="text-amber-400 font-bold bg-amber-500/10 px-3 py-1.5 rounded-lg border border-amber-500/20 inline-block text-xs">{{ __('Pending Review') }}</span>`;
                            }
                            
                            // Add a little highlight animation
                            statusContainer.innerHTML = newHtml;
                            statusContainer.classList.add('ring-2', 'ring-indigo-500', 'ring-offset-2', 'ring-offset-slate-900', 'rounded-lg', 'transition-all', 'duration-500');
                            setTimeout(() => {
                                statusContainer.classList.remove('ring-2', 'ring-indigo-500', 'ring-offset-2', 'ring-offset-slate-900');
                            }, 2000);
                        }
                    }
                });
        }
    </script>
    @endpush
</x-app-layout>
