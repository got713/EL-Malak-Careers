<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('User Details') }}: {{ $user->name }}
            </h2>
            <a href="{{ route('admin.users.index') }}" class="text-slate-400 hover:text-white transition">
                {!! __('&larr; Back to Users') !!}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="glass-card rounded-2xl p-8">
                <div class="flex items-center space-x-4 rtl:space-x-reverse mb-6 pb-4 border-b border-slate-700/50">
                    <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?d=mp&s=150' }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover border-2 border-teal-500 shadow-md">
                    <div>
                        <h4 class="text-xl font-bold text-white">{{ $user->name }}</h4>
                        <p class="text-sm text-slate-400">{{ __($user->worker_type === 'white_collar' ? 'White Collar' : ($user->worker_type === 'blue_collar' ? 'Blue Collar' : 'N/A')) }}</p>
                    </div>
                </div>

                <!-- Candidate Nomination Stats Panel -->
                <div class="grid grid-cols-3 gap-4 mb-6 bg-slate-800/40 p-4 rounded-xl border border-slate-700/50">
                    <div class="text-center">
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">{{ __('Nominated Jobs') }}</span>
                        <span class="text-2xl font-bold text-indigo-400">{{ $user->applications->count() }}</span>
                    </div>
                    <div class="text-center border-x border-slate-700/50">
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">{{ __('Accepted Jobs') }}</span>
                        <span class="text-2xl font-bold text-emerald-400">{{ $user->applications->where('status', 'accepted')->count() }}</span>
                    </div>
                    <div class="text-center">
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">{{ __('Did Interview?') }}</span>
                        @if($user->applications->whereIn('status', ['interview', 'shortlisted', 'accepted'])->isNotEmpty())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-500/10 text-purple-400 border border-purple-500/20 mt-1">
                                {{ __('Yes') }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-500/10 text-slate-400 border border-slate-500/20 mt-1">
                                {{ __('No') }}
                            </span>
                        @endif
                    </div>
                </div>

                <h3 class="text-xl font-bold text-white border-b border-slate-700/50 pb-4 mb-6">{{ __('Personal Information') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('First Name') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->first_name }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Last Name') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->last_name }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Email Address') }}</span>
                        <a href="mailto:{{ $user->email }}" class="block text-lg text-sky-400 hover:text-sky-300 hover:underline font-medium">{{ $user->email }}</a>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Phone Number') }}</span>
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <a href="tel:{{ $user->phone }}" class="block text-lg text-sky-400 hover:text-sky-300 hover:underline font-medium">{{ $user->phone }}</a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" class="text-emerald-500 hover:text-emerald-400 transition" title="{{ __('Chat on WhatsApp') }}">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Location / Area') }}</span>
                        <span class="block text-lg text-white font-medium">{{ __($user->location) }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Gender') }}</span>
                        <span class="block text-lg text-white font-medium">{{ __($user->gender === 'male' ? 'Male' : ($user->gender === 'female' ? 'Female' : 'N/A')) }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Nationality') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->nationality }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Religion') }}</span>
                        <span class="block text-lg text-white font-medium">{{ __($user->religion) }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Date of Birth (Age)') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->birth_date ? $user->birth_date->format('M d, Y') . ' (' . $user->birth_date->age . ' years)' : 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Father of Confession and his Church') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->confession_father ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __("Applicant's Church") }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->applicant_church ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Application Date') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->application_date ? $user->application_date->format('M d, Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-xl font-bold text-white border-b border-slate-700/50 pb-4 mb-6">{{ __('Professional Information') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Target Headline') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->headline ?: __('N/A') }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Years of Experience') }}</span>
                        <span class="block text-lg text-white font-medium">
                            @if(is_numeric($user->years_of_experience))
                                @if($user->years_of_experience == 0)
                                    {{ __('Fresh Graduate / No Experience') }}
                                @else
                                    {{ $user->years_of_experience }} {{ __('Years') }}
                                @endif
                            @elseif($user->years_of_experience == '0') {{ __('Fresh Graduate / No Experience') }}
                            @elseif($user->years_of_experience == '1-3') {{ __('1 to 3 Years') }}
                            @elseif($user->years_of_experience == '3-5') {{ __('3 to 5 Years') }}
                            @elseif($user->years_of_experience == '5+') {{ __('More than 5 Years') }}
                            @elseif($user->years_of_experience) {{ $user->years_of_experience }}
                            @else {{ __('N/A') }} @endif
                        </span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('LinkedIn Profile') }}</span>
                        @if($user->linkedin_url)
                            <a href="{{ $user->linkedin_url }}" target="_blank" class="block text-lg text-sky-400 hover:text-sky-300 hover:underline font-medium break-all">{{ $user->linkedin_url }}</a>
                        @else
                            <span class="block text-lg text-slate-500 font-medium">{{ __('N/A') }}</span>
                        @endif
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Current Company Name (If any)') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->current_company ?: __('N/A') }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Employment Status') }}</span>
                        <span class="block text-lg text-white font-medium">
                            @if($user->employment_status == 'employed') {{ __('Employed') }}
                            @elseif($user->employment_status == 'unemployed') {{ __('Unemployed') }}
                            @elseif($user->employment_status == 'other') {{ __('Other') }}
                            @else {{ $user->employment_status ?: __('N/A') }} @endif
                        </span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Last Salary') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->last_salary ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Languages') }}</span>
                        <span class="block text-lg text-white font-medium">
                            @if(is_array($user->languages))
                                {{ implode(', ', array_map(fn($lang) => __($lang), $user->languages)) }}
                            @else
                                {{ $user->languages ?: 'N/A' }}
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Microsoft Office - Computer Skills') }}</span>
                        <div class="flex items-center space-x-1 mt-1">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $user->microsoft_office_skills ? 'text-teal-400' : 'text-slate-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="text-sm text-slate-400 ml-2">({{ $user->microsoft_office_skills }}/5)</span>
                        </div>
                    </div>
                    <div class="md:col-span-2 mt-2">
                        <span class="block text-sm font-medium text-slate-400 mb-2">{{ __('Skills') }}</span>
                        <div class="flex flex-wrap gap-2">
                            @php $userSkills = $user->userSkills()->with('skill')->get(); @endphp
                            @forelse($userSkills as $userSkill)
                                <span class="px-3 py-1 bg-teal-500/10 text-teal-400 text-sm font-semibold rounded-full border border-teal-500/20">
                                    {{ $userSkill->skill->name }}
                                </span>
                            @empty
                                <span class="text-slate-500">{{ __('No skills listed.') }}</span>
                            @endforelse
                        </div>
                    </div>
                    <div class="md:col-span-2 mt-4 pt-4 border-t border-slate-700/50">
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Experience Details') }}</span>
                        <p class="text-white text-sm leading-relaxed whitespace-pre-line">{{ $user->experience_details ?: __('N/A') }}</p>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-xl font-bold text-white border-b border-slate-700/50 pb-4 mb-6">{{ __('Education Details') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Status') }}</span>
                        <span class="block text-lg text-white font-medium">{{ __($user->education_status === 'studying' ? 'Currently Studying' : 'Graduated') }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('Degree / Field of Study') }}</span>
                        <span class="block text-lg text-white font-medium">{{ $user->education_degree }}</span>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-xl font-bold text-white border-b border-slate-700/50 pb-4 mb-6">{{ __('Uploaded CV') }}</h3>
                
                @if($user->resumes->isNotEmpty())
                    <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-indigo-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <div>
                                    <span class="block text-white font-medium">{{ $user->resumes->first()->original_name }}</span>
                                    <span class="block text-sm text-slate-400">{{ __('Uploaded on ') }}{{ $user->resumes->first()->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('resumes.download', $user->resumes->first()) }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg">
                                {{ __('View / Download CV') }}
                            </a>
                        </div>
                        
                        @if($user->resumes->first()->description)
                            <div class="mt-4 pt-4 border-t border-slate-700/50">
                                <span class="block text-sm font-medium text-slate-400 mb-1">{{ __('CV Summary / Description') }}</span>
                                <p class="text-white text-sm leading-relaxed">{{ $user->resumes->first()->description }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-slate-400">{{ __('No CV uploaded.') }}</p>
                @endif
            </div>

            @if(auth()->user()?->hasRole('admin') && $user->recommendation_letter)
            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-xl font-bold text-amber-400 border-b border-slate-700/50 pb-4 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    {{ __('Recommendation Letter') }}
                </h3>
                
                <div class="flex items-center justify-between bg-amber-900/20 p-4 rounded-xl border border-amber-500/20">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-amber-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        <div>
                            <span class="block text-white font-medium">{{ __('Recommendation File') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('users.recommendation.download', $user) }}" target="_blank" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg">
                        {{ __('View / Download Letter') }}
                    </a>
                </div>
            </div>
            @endif

            <!-- Nominations & Applications History -->
            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-xl font-bold text-white border-b border-slate-700/50 pb-4 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    {{ __('Nominations & Applications History') }}
                </h3>
                @if($user->applications->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full ltr:text-left rtl:text-right border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700/50 text-slate-400 bg-slate-800/30 text-xs">
                                    <th class="p-3 font-semibold">{{ __('Job Title') }}</th>
                                    <th class="p-3 font-semibold">{{ __('Company Name') }}</th>
                                    <th class="p-3 font-semibold">{{ __('Application Date') }}</th>
                                    <th class="p-3 font-semibold text-center">{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800 text-sm">
                                @foreach($user->applications as $application)
                                <tr class="hover:bg-slate-800/30 transition">
                                    <td class="p-3">
                                        @if($application->job)
                                            <span class="text-white font-medium">{{ $application->job->title }}</span>
                                        @else
                                            <span class="text-slate-500 font-medium">{{ __('Deleted Job') }}</span>
                                        @endif
                                    </td>
                                    <td class="p-3 text-slate-300">
                                        {{ $application->job && $application->job->company ? $application->job->company->name : 'N/A' }}
                                    </td>
                                    <td class="p-3 text-slate-400">
                                        {{ $application->applied_at ? \Carbon\Carbon::parse($application->applied_at)->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="p-3 text-center">
                                        @if($application->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                                {{ __('Under Review') }}
                                            </span>
                                        @elseif($application->status === 'accepted')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                {{ __('Accepted') }}
                                            </span>
                                        @elseif($application->status === 'rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                                {{ __('Rejected') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-500/10 text-slate-400 border border-slate-500/20">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-slate-400 text-sm">{{ __('This candidate has not been nominated for any jobs yet.') }}</p>
                @endif
            </div>

            <!-- Admin Private Rating & Evaluation Notes Card -->
            <div class="glass-card rounded-2xl p-8 border-2 border-amber-500/30">
                <div class="flex items-center justify-between border-b border-slate-700/50 pb-4 mb-6">
                    <h3 class="text-xl font-bold text-amber-400 flex items-center gap-2">
                        <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        {{ __('Admin Rating & Evaluation Notes') }}
                    </h3>
                    <span class="text-xs bg-amber-500/10 text-amber-300 px-3 py-1 rounded-full border border-amber-500/20 font-bold">
                        {{ __('Internal Use Only') }}
                    </span>
                </div>

                <form action="{{ route('admin.users.updateNotes', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Rating Stars -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">{{ __('Candidate Star Rating') }}</label>
                        <div class="flex items-center gap-3">
                            @for($star = 1; $star <= 5; $star++)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="admin_rating" value="{{ $star }}" class="sr-only peer" {{ old('admin_rating', $user->admin_rating) == $star ? 'checked' : '' }}>
                                    <svg class="w-8 h-8 text-slate-700 peer-checked:text-amber-400 group-hover:text-amber-300 transition" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </label>
                            @endfor
                            <span class="text-xs text-slate-400 font-bold rtl:mr-3 ltr:ml-3">
                                {{ $user->admin_rating ? $user->admin_rating . ' / 5 ' . __('Stars') : __('Not Rated') }}
                            </span>
                        </div>
                    </div>

                    <!-- Private Notes Textarea -->
                    <div>
                        <label for="admin_notes" class="block text-sm font-semibold text-slate-300 mb-2">{{ __('Private Admin Notes & Interview Feedback') }}</label>
                        <textarea id="admin_notes" name="admin_notes" rows="4" class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl p-4 text-sm focus:border-amber-500 focus:ring-amber-500/20" placeholder="{{ __('Add confidential notes regarding interview performance, suitability, or internal recommendations...') }}">{{ old('admin_notes', $user->admin_notes) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ __('Save Rating & Notes') }}
                        </button>
                        @if($user->notesUpdatedBy)
                            <span class="text-xs text-slate-500">{{ __('Last updated by') }} {{ $user->notesUpdatedBy->name }}</span>
                        @endif
                    </div>
                </form>
            </div>
            </div>

        </div>
    </div>
</x-app-layout>
