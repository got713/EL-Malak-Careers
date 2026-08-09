<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Malak Careers') }} - {{ __('Company Registration') }}</title>
    
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

        /* Custom Scrollbar for form */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #23364A; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #14B8A6; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="antialiased min-h-screen flex overflow-hidden selection:bg-teal-500 selection:text-white">

    <!-- LEFT SIDE: Marketing (Hidden on Mobile) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-cover bg-center overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80');">
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
    <div class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-8 relative overflow-y-auto">
        
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
            <div class="w-full max-w-[600px] animate-slide-up">
                
                <div class="glass-card p-6 sm:p-8 mt-12 sm:mt-0 relative">
                    
                    <a href="{{ route('register') }}" class="absolute top-6 start-6 text-slate-400 hover:text-white transition-colors flex items-center gap-2 text-sm font-medium bg-[#081B29] px-3 py-1.5 rounded-lg border border-[#23364A]">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        {{ __('Back') }}
                    </a>

                    <div class="text-center mb-6 mt-10">
                        <h2 class="text-xl font-bold text-white mb-1">🏢 {{ __('Company Registration') }}</h2>
                        <p class="text-[#94A3B8] text-xs">{{ __('Create a company account to start posting jobs.') }}</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('company.register') }}" enctype="multipart/form-data" class="flex flex-col">
                        @csrf

                        <!-- Scrollable Fields Area -->
                        <div class="overflow-y-auto max-h-[45vh] custom-scrollbar pe-3 me-[-12px] space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                
                                <!-- Company Name -->
                                <div>
                                    <label for="company_name" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Company Name') }}</label>
                                    <input id="company_name" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="company_name" value="{{ old('company_name') }}" required autofocus />
                                    <x-input-error :messages="$errors->get('company_name')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Email Address') }}</label>
                                    <input id="email" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="email" name="email" value="{{ old('email') }}" required dir="ltr" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Password') }}</label>
                                    <input id="password" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="password" name="password" required dir="ltr" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="password" name="password_confirmation" required dir="ltr" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                                <!-- Industry -->
                                <div>
                                    <label for="industry" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Industry / Specialization') }}</label>
                                    <input id="industry" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="text" name="industry" value="{{ old('industry') }}" placeholder="{{ __('e.g. Software, Real Estate') }}" required />
                                    <x-input-error :messages="$errors->get('industry')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
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

                                <!-- LinkedIn -->
                                <div class="md:col-span-2 pb-2">
                                    <label for="linkedin" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('LinkedIn Account URL') }}</label>
                                    <input id="linkedin" class="input-login w-full rounded-xl py-2.5 text-sm px-4 ltr:text-left rtl:text-right" type="url" name="linkedin" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/company/yourcompany" dir="ltr" />
                                    <x-input-error :messages="$errors->get('linkedin')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                                </div>

                            </div>
                        </div>

                        <!-- Fixed Footer Actions -->
                        <div class="mt-6 pt-4 border-t border-[#23364A] flex flex-col gap-4">
                            <button type="submit" class="btn-gradient w-full rounded-xl h-[46px] text-center text-sm font-bold text-white focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-[#112235]">
                                {{ __('Create Company Account') }}
                            </button>
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

</body>
</html>
