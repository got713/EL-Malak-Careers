<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->name }} - {{ __('Curriculum Vitae') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Cairo', 'Outfit', sans-serif;
            background-color: #0f172a;
            color: #0f172a;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
                color: #0f172a !important;
                padding: 0 !important;
            }
            .cv-container {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }
        }
    </style>
</head>
<body class="py-8 px-4 bg-slate-950 text-slate-900 antialiased min-h-screen">

    <!-- Action Toolbar (Hidden in Print) -->
    <div class="no-print max-w-4xl mx-auto mb-6 flex flex-wrap items-center justify-between gap-4 bg-slate-900/90 border border-slate-800 p-4 rounded-2xl shadow-xl backdrop-blur-md">
        <a href="{{ route('profile.edit') }}" class="text-slate-400 hover:text-white text-sm font-bold transition flex items-center gap-2">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __('Back to Profile Settings') }}
        </a>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-400 hover:to-emerald-400 text-white font-bold px-6 py-2.5 rounded-xl shadow-lg transition flex items-center gap-2 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                {{ __('Print / Save as PDF') }}
            </button>
        </div>
    </div>

    <!-- Generated Printable CV Sheet -->
    <div class="cv-container max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200 text-slate-800">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white p-8 sm:p-10 border-b-4 border-teal-500">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-2 text-white">{{ $user->name }}</h1>
                    <p class="text-teal-400 font-bold text-lg sm:text-xl">{{ $user->headline ?: __('Job Seeker') }}</p>
                </div>
                
                <div class="space-y-1.5 text-xs sm:text-sm text-slate-300 font-medium ltr:text-left rtl:text-right">
                    @if($user->phone)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span dir="ltr">{{ $user->phone }}</span>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-teal-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span dir="ltr">{{ $user->email }}</span>
                    </div>
                    @if($user->location)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span>{{ $user->location }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Body Content -->
        <div class="p-8 sm:p-10 space-y-8">
            
            <!-- Summary & Highlights Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-200 text-center">
                <div>
                    <span class="block text-xs font-bold text-slate-500 uppercase mb-1">{{ __('Years of Experience') }}</span>
                    <span class="text-base font-extrabold text-slate-900">{{ $user->years_of_experience ?: 'N/A' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-slate-500 uppercase mb-1">{{ __('Education Status') }}</span>
                    <span class="text-base font-extrabold text-slate-900">{{ $user->education_status ?: 'N/A' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-slate-500 uppercase mb-1">{{ __('Employment Status') }}</span>
                    <span class="text-base font-extrabold text-slate-900">{{ $user->employment_status ?: 'N/A' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-slate-500 uppercase mb-1">{{ __('Worker Type') }}</span>
                    <span class="text-base font-extrabold text-slate-900">{{ $user->worker_type === 'white_collar' ? __('Office / Professional') : ($user->worker_type === 'blue_collar' ? __('Technical / Skilled') : 'N/A') }}</span>
                </div>
            </div>

            <!-- Academic Background -->
            <div>
                <h3 class="text-lg font-bold text-slate-900 border-b-2 border-slate-200 pb-2 mb-4 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                    {{ __('Academic Background') }}
                </h3>
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-base text-slate-900">{{ $user->education_degree ?: __('Degree Not Specified') }}</h4>
                    <p class="text-sm text-slate-500 font-medium mt-1">{{ __('Status') }}: {{ $user->education_status ?: __('Not Specified') }}</p>
                </div>
            </div>

            <!-- Professional Experience & Details -->
            @if($user->experience_details)
            <div>
                <h3 class="text-lg font-bold text-slate-900 border-b-2 border-slate-200 pb-2 mb-4 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    {{ __('Professional Experience & Summary') }}
                </h3>
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $user->experience_details }}</p>
                    @if($user->current_company)
                        <div class="mt-3 pt-3 border-t border-slate-100 text-xs font-semibold text-slate-600">
                            {{ __('Current / Previous Employer') }}: <span class="text-slate-900">{{ $user->current_company }}</span>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Skills & Languages Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Skills -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 border-b-2 border-slate-200 pb-2 mb-4 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        {{ __('Skills & Expertise') }}
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse($user->userSkills as $userSkill)
                            <span class="text-xs font-bold bg-slate-100 text-slate-800 px-3 py-1.5 rounded-lg border border-slate-300">{{ $userSkill->skill->name }}</span>
                        @empty
                            <span class="text-xs text-slate-500">{{ __('No skills listed.') }}</span>
                        @endforelse
                    </div>
                </div>

                <!-- Languages & Computer -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 border-b-2 border-slate-200 pb-2 mb-4 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
                        {{ __('Languages & Computer Skills') }}
                    </h3>
                    <div class="space-y-2 text-xs font-semibold text-slate-700">
                        <div>{{ __('Languages') }}: <span class="font-bold text-slate-900">{{ is_array($user->languages) ? implode(', ', $user->languages) : ($user->languages ?: 'Arabic') }}</span></div>
                        <div>{{ __('MS Office & Computer') }}: <span class="font-bold text-slate-900">{{ $user->microsoft_office_skills ? $user->microsoft_office_skills . ' / 5' : 'Good' }}</span></div>
                    </div>
                </div>
            </div>

            <!-- Personal & Community Information -->
            <div>
                <h3 class="text-lg font-bold text-slate-900 border-b-2 border-slate-200 pb-2 mb-4 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ __('Personal & Community Details') }}
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs font-medium text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <div><span class="block text-slate-500 uppercase">{{ __('Religion') }}</span><span class="font-bold text-slate-900 text-sm">{{ $user->religion ?: 'N/A' }}</span></div>
                    <div><span class="block text-slate-500 uppercase">{{ __('Nationality') }}</span><span class="font-bold text-slate-900 text-sm">{{ $user->nationality ?: 'Egyptian' }}</span></div>
                    <div><span class="block text-slate-500 uppercase">{{ __('Date of Birth') }}</span><span class="font-bold text-slate-900 text-sm">{{ $user->birth_date ? $user->birth_date->format('Y-m-d') : 'N/A' }}</span></div>
                    @if($user->confession_father)
                        <div><span class="block text-slate-500 uppercase">{{ __('Father of Confession') }}</span><span class="font-bold text-slate-900 text-sm">{{ $user->confession_father }}</span></div>
                    @endif
                    @if($user->applicant_church)
                        <div><span class="block text-slate-500 uppercase">{{ __("Applicant's Church") }}</span><span class="font-bold text-slate-900 text-sm">{{ $user->applicant_church }}</span></div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="bg-slate-100 p-6 border-t border-slate-200 text-center text-xs text-slate-500 font-semibold flex items-center justify-between">
            <span>{{ __('Generated via Malak Careers Platform') }}</span>
            <span class="font-mono text-slate-400">{{ now()->format('Y-m-d') }}</span>
        </div>

    </div>

</body>
</html>
