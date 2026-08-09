<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Malak Careers') }} - {{ __('Create Account') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; background-color: #081B29; color: #FFFFFF; }
        html[dir="rtl"] body, html[dir="rtl"] input, html[dir="rtl"] button, html[dir="rtl"] select { font-family: 'Cairo', sans-serif !important; }
        .gradient-text { background: linear-gradient(to right, #14B8A6, #0F766E); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .glass-card { background: #112235; border: 1px solid #23364A; border-radius: 18px; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .input-login { background: #081B29; border: 1px solid #23364A; color: #FFFFFF; transition: all 250ms ease; }
        .input-login:focus { border-color: #14B8A6; box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.2); outline: none; }
        .btn-gradient { background: linear-gradient(to right, #14B8A6, #0F766E); transition: all 250ms ease; }
        .btn-gradient:hover { filter: brightness(1.1); transform: scale(1.02); box-shadow: 0 10px 20px rgba(20, 184, 166, 0.3); }
        .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
        .animate-slide-up { animation: slideUp 0.8s ease-out forwards; }
        
        /* Fix Chrome Autofill white background bug in dark mode */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #081B29 inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Custom Scrollbar for form and global page in dark mode */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #081B29 !important; }
        ::-webkit-scrollbar-thumb { background: #23364A !important; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #14B8A6 !important; }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #081B29 !important; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #23364A !important; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #14B8A6 !important; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="antialiased min-h-screen bg-[#081B29] selection:bg-teal-500 selection:text-white">

    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- LEFT SIDE: Marketing (Hidden on Mobile) -->
        <div class="hidden lg:flex lg:w-5/12 xl:w-4/12 sticky top-0 h-screen overflow-hidden bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80');">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#081B29]/95 via-[#081B29]/90 to-[#0F766E]/80 backdrop-blur-[2px]"></div>
            
            <div class="relative z-10 flex flex-col justify-between h-full p-10 w-full max-w-xl mx-auto animate-fade-in text-start">
                
                <div class="mt-4 flex flex-col items-center text-center lg:items-start lg:text-start">
                    <a href="/" class="inline-block mb-12 lg:self-center">
                        <img src="{{ asset('images/logo.svg') }}" alt="Malak Careers Logo" class="h-24 sm:h-32 w-auto filter brightness-0 invert drop-shadow-2xl hover:scale-105 transition-transform duration-300">
                    </a>
                    <h1 class="text-4xl xl:text-5xl font-extrabold text-white leading-tight mb-4">
                        {{ __('Find your') }} <br>
                        <span class="gradient-text">{{ __('Dream Career') }}</span>
                    </h1>
                    <p class="text-base xl:text-lg text-slate-300 mb-8 max-w-md leading-relaxed">
                        {{ __('Malak Careers connects talented professionals with the best companies and career opportunities.') }}
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse text-slate-200">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center backdrop-blur-md">
                                <span class="text-xl">💼</span>
                            </div>
                            <span class="text-base font-medium">{{ __('Find Jobs') }}</span>
                        </div>
                        <div class="flex items-center space-x-3 rtl:space-x-reverse text-slate-200">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center backdrop-blur-md">
                                <span class="text-xl">👥</span>
                            </div>
                            <span class="text-base font-medium">{{ __('Hire Talent') }}</span>
                        </div>
                        <div class="flex items-center space-x-3 rtl:space-x-reverse text-slate-200">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center backdrop-blur-md">
                                <span class="text-xl">📈</span>
                            </div>
                            <span class="text-base font-medium">{{ __('Build Your Future') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-auto">
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: Register Card -->
        <div class="w-full lg:w-7/12 xl:w-8/12 min-h-screen flex flex-col justify-between p-6 sm:p-12 relative bg-[#081B29]">
            
            <!-- Top Nav (Language) -->
            <div class="absolute top-6 end-6 z-50 animate-fade-in text-start">
                @if(app()->getLocale() == 'en')
                    <a href="{{ route('lang.switch', 'ar') }}" class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-slate-400 hover:text-white transition-colors bg-[#112235] px-3 py-1.5 rounded-lg border border-[#23364A]">
                        🌐 <span>AR</span>
                    </a>
                @else
                    <a href="{{ route('lang.switch', 'en') }}" class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-slate-400 hover:text-white transition-colors bg-[#112235] px-3 py-1.5 rounded-lg border border-[#23364A]">
                        🌐 <span>EN</span>
                    </a>
                @endif
            </div>

            <!-- Top Start (Logo - Mobile Only) -->
            <div class="absolute top-6 start-6 z-50 animate-fade-in lg:hidden">
                <a href="/">
                    <img src="{{ asset('images/logo.svg') }}" alt="Malak Careers Logo" class="h-12 w-auto filter brightness-0 invert opacity-90">
                </a>
            </div>

            <div class="flex-grow flex items-center justify-center py-6 text-start">
                <div x-data="{ step: {{ $errors->any() ? 2 : 1 }}, accountType: null }" class="w-full max-w-2xl animate-slide-up">
                
                <!-- STEP 1: Selection -->
                <div x-cloak x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="glass-card p-6 sm:p-10 mt-12 sm:mt-0 relative overflow-hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-white mb-2">🚀 {{ __('Create Your Account') }}</h2>
                        <p class="text-[#94A3B8] text-sm">{{ __('Choose how you want to use Malak Careers.') }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Job Seeker Card -->
                        <div @click="accountType = 'job_seeker'" 
                            :class="{'border-teal-500 shadow-[0_0_20px_rgba(20,184,166,0.2)] bg-[#112235]': accountType === 'job_seeker', 'border-[#23364A] hover:border-teal-500/50 bg-[#081B29]/50': accountType !== 'job_seeker'}"
                            class="relative p-6 rounded-2xl border-2 cursor-pointer transition-all duration-300 hover:scale-[1.03] flex flex-col items-center text-center group">
                            
                            <!-- Checkmark -->
                            <div x-show="accountType === 'job_seeker'" x-transition class="absolute top-4 end-4 text-teal-400 bg-teal-400/10 rounded-full p-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </div>

                            <div class="w-16 h-16 bg-[#112235] rounded-full flex items-center justify-center mb-4 text-3xl shadow-inner border border-[#23364A] group-hover:scale-110 transition-transform duration-300">👤</div>
                            <h3 class="text-lg font-bold text-white mb-2">{{ __('Job Seeker') }}</h3>
                            <p class="text-xs text-[#94A3B8] leading-relaxed">{{ __('Create a personal account to search for jobs, apply to positions, upload your CV, and manage your career.') }}</p>
                        </div>

                        <!-- Company Card -->
                        <div @click="accountType = 'company'" 
                            :class="{'border-teal-500 shadow-[0_0_20px_rgba(20,184,166,0.2)] bg-[#112235]': accountType === 'company', 'border-[#23364A] hover:border-teal-500/50 bg-[#081B29]/50': accountType !== 'company'}"
                            class="relative p-6 rounded-2xl border-2 cursor-pointer transition-all duration-300 hover:scale-[1.03] flex flex-col items-center text-center group">
                            
                            <!-- Checkmark -->
                            <div x-show="accountType === 'company'" x-transition class="absolute top-4 end-4 text-teal-400 bg-teal-400/10 rounded-full p-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </div>

                            <div class="w-16 h-16 bg-[#112235] rounded-full flex items-center justify-center mb-4 text-3xl shadow-inner border border-[#23364A] group-hover:scale-110 transition-transform duration-300">🏢</div>
                            <h3 class="text-lg font-bold text-white mb-2">{{ __('Company') }}</h3>
                            <p class="text-xs text-[#94A3B8] leading-relaxed">{{ __('Create a company account to post jobs, manage applicants, and hire talented professionals.') }}</p>
                        </div>
                    </div>

                    <button @click="if(accountType === 'job_seeker') { step = 2 } else if(accountType === 'company') { window.location.href = '{{ route('company.register') }}' }" 
                            :disabled="!accountType"
                            :class="{'opacity-50 cursor-not-allowed grayscale': !accountType, 'hover:scale-[1.02] hover:shadow-lg hover:shadow-teal-500/30': accountType}"
                            class="btn-gradient w-full rounded-xl h-[54px] text-center text-base font-bold text-white transition-all duration-300">
                        {{ __('Continue') }}
                    </button>

                    <div class="text-center mt-6">
                        <p class="text-[#94A3B8] text-sm">
                            {{ __("Already registered?") }} 
                            <a href="{{ route('login') }}" class="font-bold text-teal-400 hover:text-teal-300 transition-colors ms-1">{{ __('Log in') }}</a>
                        </p>
                    </div>
                </div>

                <!-- STEP 2: Job Seeker Form -->
                <div x-cloak x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-8" x-transition:enter-end="opacity-100 transform translate-x-0" class="glass-card p-6 sm:p-8 mt-12 sm:mt-0 relative">
                    
                    <button @click="step = 1" type="button" class="absolute top-6 start-6 text-slate-400 hover:text-white transition-colors flex items-center gap-2 text-sm font-medium bg-[#081B29] px-3 py-1.5 rounded-lg border border-[#23364A]">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        {{ __('Back') }}
                    </button>

                    <div class="text-center mb-6 mt-10">
                        <h2 class="text-xl font-bold text-white mb-1">👤 {{ __('Job Seeker Registration') }}</h2>
                        <p class="text-[#94A3B8] text-xs">{{ __('Fill in your details to create your personal account.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="flex flex-col">
                        @csrf

                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                
                                <!-- First Name -->
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('First Name') }}</label>
                                    <input id="first_name" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="given-name" />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Last Name') }}</label>
                                    <input id="last_name" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name" />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Email') }}</label>
                                    <input id="email" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" dir="ltr" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Phone Number') }}</label>
                                    <input id="phone" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="phone" value="{{ old('phone') }}" required dir="ltr" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Password') }}</label>
                                    <input id="password" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="password" name="password" required autocomplete="new-password" dir="ltr" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="password" name="password_confirmation" required autocomplete="new-password" dir="ltr" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Location -->
                                <div>
                                    <label for="location" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Location (City/Area)') }}</label>
                                    <select id="location" name="location" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" required>
                                        <option value="" disabled selected class="bg-[#081B29]">{{ __('Select Location') }}</option>
                                        <option value="Cairo" class="bg-[#081B29]" {{ old('location') == 'Cairo' ? 'selected' : '' }}>{{ __('Cairo') }}</option>
                                        <option value="Alexandria" class="bg-[#081B29]" {{ old('location') == 'Alexandria' ? 'selected' : '' }}>{{ __('Alexandria') }}</option>
                                        <option value="Giza" class="bg-[#081B29]" {{ old('location') == 'Giza' ? 'selected' : '' }}>{{ __('Giza') }}</option>
                                        <option value="Other" class="bg-[#081B29]" {{ old('location') == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('location')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Religion -->
                                <div>
                                    <label for="religion" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Religion') }}</label>
                                    <select id="religion" name="religion" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" required>
                                        <option value="" disabled selected class="bg-[#081B29]">{{ __('Select Religion') }}</option>
                                        <option value="Muslim" class="bg-[#081B29]" {{ old('religion') == 'Muslim' ? 'selected' : '' }}>{{ __('Muslim') }}</option>
                                        <option value="Christian" class="bg-[#081B29]" {{ old('religion') == 'Christian' ? 'selected' : '' }}>{{ __('Christian') }}</option>
                                        <option value="Other" class="bg-[#081B29]" {{ old('religion') == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('religion')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Nationality -->
                                <div>
                                    <label for="nationality" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Nationality') }}</label>
                                    <input id="nationality" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="nationality" value="{{ old('nationality') }}" required />
                                    <x-input-error :messages="$errors->get('nationality')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Date of Birth -->
                                <div>
                                    <label for="birth_date" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Date of Birth (Age)') }}</label>
                                    <input id="birth_date" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="date" name="birth_date" value="{{ old('birth_date') }}" required />
                                    <x-input-error :messages="$errors->get('birth_date')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Gender') }}</label>
                                    <select id="gender" name="gender" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" required>
                                        <option value="" disabled selected class="bg-[#081B29]">{{ __('Select Gender') }}</option>
                                        <option value="male" class="bg-[#081B29]" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                        <option value="female" class="bg-[#081B29]" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Target Job Title / Headline -->
                                <div class="md:col-span-2">
                                    <label for="headline" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Target Job Title / Headline') }} <span class="text-red-400">*</span></label>
                                    <input id="headline" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="headline" value="{{ old('headline') }}" placeholder="{{ __('e.g. Software Engineer, Financial Accountant') }}" required />
                                    <x-input-error :messages="$errors->get('headline')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Years of Experience -->
                                <div>
                                    <label for="years_of_experience" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Years of Experience (in years)') }} <span class="text-red-400">*</span></label>
                                    <input id="years_of_experience" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="number" min="0" max="50" name="years_of_experience" value="{{ old('years_of_experience', 0) }}" placeholder="0" dir="ltr" required />
                                    <x-input-error :messages="$errors->get('years_of_experience')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- LinkedIn URL -->
                                <div>
                                    <label for="linkedin_url" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('LinkedIn Profile URL (Optional)') }}</label>
                                    <input id="linkedin_url" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/in/..." dir="ltr" />
                                    <x-input-error :messages="$errors->get('linkedin_url')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Skills -->
                                <div class="md:col-span-2">
                                    <label for="skills" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Your Skills (Comma Separated)') }}</label>
                                    <input id="skills" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="skills" value="{{ old('skills') }}" placeholder="{{ __('e.g. PHP, Laravel, Marketing, Communication') }}" />
                                    <x-input-error :messages="$errors->get('skills')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Education Status -->
                                <div class="md:col-span-2">
                                    <label for="education_status" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Education Status') }}</label>
                                    <select id="education_status" name="education_status" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" required>
                                        <option value="" disabled selected class="bg-[#081B29]">{{ __('Select Status') }}</option>
                                        <option value="studying" class="bg-[#081B29]" {{ old('education_status') == 'studying' ? 'selected' : '' }}>{{ __('Currently Studying') }}</option>
                                        <option value="graduated" class="bg-[#081B29]" {{ old('education_status') == 'graduated' ? 'selected' : '' }}>{{ __('Graduated') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('education_status')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Education Degree -->
                                <div class="md:col-span-2">
                                    <label for="education_degree" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Education Degree / Field of Study') }} <span class="text-red-400">*</span></label>
                                    <input id="education_degree" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="education_degree" value="{{ old('education_degree') }}" required placeholder="{{ __('e.g. Bachelor of Computer Science') }}" />
                                    <x-input-error :messages="$errors->get('education_degree')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Father of Confession & Church -->
                                <div>
                                    <label for="confession_father" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Father of Confession and his Church') }} <span class="text-red-400">*</span></label>
                                    <input id="confession_father" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="confession_father" value="{{ old('confession_father') }}" required placeholder="{{ __('e.g. Fr. Shenouda - St. Mary Church') }}" />
                                    <x-input-error :messages="$errors->get('confession_father')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Applicant's Church -->
                                <div>
                                    <label for="applicant_church" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __("Applicant's Church") }} <span class="text-red-400">*</span></label>
                                    <input id="applicant_church" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="applicant_church" value="{{ old('applicant_church') }}" required placeholder="{{ __('e.g. St. Mark Church, Heliopolis') }}" />
                                    <x-input-error :messages="$errors->get('applicant_church')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Current Company Name -->
                                <div>
                                    <label for="current_company" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Current Company Name (If any)') }}</label>
                                    <input id="current_company" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="current_company" value="{{ old('current_company') }}" placeholder="{{ __('e.g. Vodafone Egypt') }}" />
                                    <x-input-error :messages="$errors->get('current_company')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Employment Status -->
                                <div>
                                    <label for="employment_status" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Employment Status') }} <span class="text-red-400">*</span></label>
                                    <select id="employment_status" name="employment_status" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" required>
                                        <option value="" disabled selected class="bg-[#081B29]">{{ __('Select Status') }}</option>
                                        <option value="employed" class="bg-[#081B29]" {{ old('employment_status') == 'employed' ? 'selected' : '' }}>{{ __('Employed') }}</option>
                                        <option value="unemployed" class="bg-[#081B29]" {{ old('employment_status') == 'unemployed' ? 'selected' : '' }}>{{ __('Unemployed') }}</option>
                                        <option value="other" class="bg-[#081B29]" {{ old('employment_status') == 'other' ? 'selected' : '' }}>{{ __('Other (Specify)') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('employment_status')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Application Date -->
                                <div>
                                    <label for="application_date" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Application Date') }} <span class="text-red-400">*</span></label>
                                    <input id="application_date" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="date" name="application_date" value="{{ old('application_date', date('Y-m-d')) }}" required />
                                    <x-input-error :messages="$errors->get('application_date')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Last Salary -->
                                <div>
                                    <label for="last_salary" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Last Salary') }} <span class="text-red-400">*</span></label>
                                    <input id="last_salary" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="last_salary" value="{{ old('last_salary') }}" required placeholder="{{ __('e.g. 5000 EGP') }}" />
                                    <x-input-error :messages="$errors->get('last_salary')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Languages -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-300 mb-2 ltr:text-left rtl:text-right">{{ __('Languages') }}</label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-[#081B29]/30 p-3 rounded-xl border border-[#23364A]">
                                        <label class="flex items-center space-x-2 rtl:space-x-reverse cursor-pointer">
                                            <input type="checkbox" name="languages[]" value="Arabic" class="rounded border-[#23364A] bg-[#081B29] text-teal-500 focus:ring-teal-500" {{ (is_array(old('languages')) && in_array('Arabic', old('languages'))) ? 'checked' : '' }}>
                                            <span class="text-sm text-slate-300">{{ __('Arabic') }}</span>
                                        </label>
                                        <label class="flex items-center space-x-2 rtl:space-x-reverse cursor-pointer">
                                            <input type="checkbox" name="languages[]" value="English" class="rounded border-[#23364A] bg-[#081B29] text-teal-500 focus:ring-teal-500" {{ (is_array(old('languages')) && in_array('English', old('languages'))) ? 'checked' : '' }}>
                                            <span class="text-sm text-slate-300">{{ __('English') }}</span>
                                        </label>
                                        <label class="flex items-center space-x-2 rtl:space-x-reverse cursor-pointer">
                                            <input type="checkbox" name="languages[]" value="French" class="rounded border-[#23364A] bg-[#081B29] text-teal-500 focus:ring-teal-500" {{ (is_array(old('languages')) && in_array('French', old('languages'))) ? 'checked' : '' }}>
                                            <span class="text-sm text-slate-300">{{ __('French') }}</span>
                                        </label>
                                        <label class="flex items-center space-x-2 rtl:space-x-reverse cursor-pointer">
                                            <input type="checkbox" name="languages[]" value="Other" class="rounded border-[#23364A] bg-[#081B29] text-teal-500 focus:ring-teal-500" {{ (is_array(old('languages')) && in_array('Other', old('languages'))) ? 'checked' : '' }}>
                                            <span class="text-sm text-slate-300">{{ __('Other (Specify)') }}</span>
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('languages')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Microsoft Office - Computer Skills -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-300 mb-2 ltr:text-left rtl:text-right">{{ __('Microsoft Office - Computer Skills') }} <span class="text-red-400">*</span></label>
                                    <div class="flex items-center justify-between gap-2 bg-[#081B29]/30 p-3 rounded-xl border border-[#23364A]">
                                        @foreach([1, 2, 3, 4, 5] as $score)
                                            <label class="flex-grow cursor-pointer text-center">
                                                <input type="radio" name="microsoft_office_skills" value="{{ $score }}" class="sr-only peer" {{ old('microsoft_office_skills') == $score ? 'checked' : '' }} required>
                                                <div class="py-2 rounded-lg border border-[#23364A] bg-[#081B29]/50 text-slate-400 font-bold peer-checked:border-teal-500 peer-checked:bg-teal-900/20 peer-checked:text-white transition-all hover:border-teal-500/50">
                                                    {{ $score }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('microsoft_office_skills')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Experience Details -->
                                <div class="md:col-span-2">
                                    <label for="experience_details" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Experience Details') }} <span class="text-red-400">*</span></label>
                                    <textarea id="experience_details" name="experience_details" rows="3" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" placeholder="{{ __('Please describe your previous experience and responsibilities in detail...') }}" required>{{ old('experience_details') }}</textarea>
                                    <x-input-error :messages="$errors->get('experience_details')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- CV Upload -->
                                <div class="md:col-span-2 mt-2 p-5 border-2 border-dashed border-[#23364A] hover:border-teal-500 rounded-xl bg-[#081B29]/50 transition duration-300 flex flex-col items-center justify-center text-center group cursor-pointer relative">
                                    <div class="w-10 h-10 bg-teal-900/30 text-teal-400 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    </div>
                                    <span class="text-sm font-semibold text-white pointer-events-none">{{ __('Upload CV (PDF Only)') }} <span class="text-red-400">*</span></span>
                                    <p class="text-xs text-slate-400 mt-1 pointer-events-none">{{ __('Drag and drop your PDF file here or click to browse (Max 10MB)') }}</p>
                                    <input id="cv" type="file" name="cv" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required />
                                    <x-input-error :messages="$errors->get('cv')" class="mt-2 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- CV Description -->
                                <div class="md:col-span-2">
                                    <label for="cv_description" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Describe your CV / Write a brief summary') }}</label>
                                    <textarea id="cv_description" name="cv_description" rows="3" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" placeholder="{{ __('Tell us a bit about your professional background, skills, or what you are looking for...') }}">{{ old('cv_description') }}</textarea>
                                    <x-input-error :messages="$errors->get('cv_description')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Personal Photo -->
                                <div class="md:col-span-2 mt-2 p-5 border-2 border-dashed border-[#23364A] hover:border-teal-500 rounded-xl bg-[#081B29]/50 transition duration-300 flex flex-col items-center justify-center text-center group cursor-pointer relative">
                                    <div class="w-10 h-10 bg-teal-900/30 text-teal-400 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="text-sm font-semibold text-white pointer-events-none">{{ __('Personal Photo') }} <span class="text-red-400">*</span></span>
                                    <p class="text-xs text-slate-400 mt-1 pointer-events-none">{{ __('Upload a professional photo (JPG, JPEG, PNG, WEBP - Max 10MB)') }}</p>
                                    <input id="avatar" type="file" name="avatar" accept=".jpg,.jpeg,.png,.webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required />
                                    <x-input-error :messages="$errors->get('avatar')" class="mt-2 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Recommendation Letter -->
                                <div class="md:col-span-2 mt-2 p-5 border-2 border-dashed border-[#23364A] hover:border-amber-500 rounded-xl bg-[#081B29]/50 transition duration-300 flex flex-col items-center justify-center text-center group cursor-pointer relative">
                                    <div class="w-10 h-10 bg-amber-900/30 text-amber-400 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <span class="text-sm font-semibold text-white pointer-events-none">{{ __('Upload Recommendation Letter from Father/Priest (Optional)') }}</span>
                                    <p class="text-xs text-slate-400 mt-1 pointer-events-none">{{ __('PDF, DOC, JPG, PNG') }}</p>
                                    <input id="recommendation_letter" type="file" name="recommendation_letter" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                                    <x-input-error :messages="$errors->get('recommendation_letter')" class="mt-2 ltr:text-left rtl:text-right text-xs" />
                                </div>
                            </div>
                        </div>

                        <!-- Fixed Footer Actions -->
                        <div class="mt-6 pt-4 border-t border-[#23364A] flex flex-col gap-4">
                            <button type="submit" class="btn-gradient w-full rounded-xl h-[46px] text-center text-sm font-bold text-white focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-[#112235]">
                                {{ __('Create Job Seeker Account') }}
                            </button>
                            
                            <!-- Google Sign Up -->
                            <a href="{{ route('auth.google') }}" class="w-full h-[46px] flex items-center justify-center rounded-xl bg-white text-slate-900 font-semibold text-sm transition-all hover:bg-slate-100 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#112235]">
                                <svg class="h-4 w-4 me-2" viewBox="0 0 24 24">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                                {{ __('Continue with Google') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-auto pt-6 text-center text-xs text-[#94A3B8] animate-fade-in">
            <span>&copy; {{ date('Y') }} {{ config('app.name', 'Malak Careers') }}</span>
        </div>

        </div>

    </div>

</body>
</html>
