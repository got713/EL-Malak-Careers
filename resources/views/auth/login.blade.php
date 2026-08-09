<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Malak Careers') }} - {{ __('Login') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; background-color: #081B29; color: #FFFFFF; }
        html[dir="rtl"] body, html[dir="rtl"] input, html[dir="rtl"] button { font-family: 'Cairo', sans-serif !important; }
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
                <!-- Removed Trusted by -->
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE: Login Card -->
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
            <div class="w-full max-w-[480px] animate-slide-up">
                
                <div class="glass-card p-6 sm:p-8 mt-12 sm:mt-0">
                    <div class="text-center mb-6">
                        <p class="text-teal-400 font-medium tracking-wide text-sm mb-1 uppercase">{{ __('Connecting Talent with Opportunity') }}</p>
                        <h2 class="text-2xl font-bold text-white mb-1">👋 {{ __('Welcome Back') }}</h2>
                        <p class="text-[#94A3B8] text-sm">{{ __('Sign in to access your career dashboard.') }}</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <!-- Email -->
                        <div class="w-full">
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Email') }}</label>
                            <div class="relative flex items-center">
                                <div class="absolute inset-y-0 ltr:left-0 rtl:right-0 ltr:pl-3.5 rtl:pr-3.5 flex items-center pointer-events-none text-slate-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" dir="ltr" class="input-login w-full rounded-xl py-2.5 text-sm ltr:pl-10 rtl:pr-10 rtl:pl-4 ltr:pr-4 ltr:text-left rtl:text-right" placeholder="example@email.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                        </div>

                        <!-- Password -->
                        <div x-data="{ showPassword: false }" class="w-full">
                            <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Password') }}</label>
                            <div class="relative flex items-center">
                                <div class="absolute inset-y-0 ltr:left-0 rtl:right-0 ltr:pl-3.5 rtl:pr-3.5 flex items-center pointer-events-none text-slate-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <input id="password" x-bind:type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" dir="ltr" class="input-login w-full rounded-xl py-2.5 text-sm ltr:pl-10 rtl:pr-10 ltr:pr-12 rtl:pl-12 ltr:text-left rtl:text-right" placeholder="••••••••">
                                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center justify-center w-10 text-slate-500 hover:text-teal-400 transition-colors focus:outline-none rounded-lg">
                                    <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg x-show="showPassword" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 ltr:text-left rtl:text-right text-xs" />
                        </div>

                        <!-- Options -->
                        <div class="flex flex-row items-center justify-between w-full pt-1">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                                <input id="remember_me" type="checkbox" class="rounded bg-[#081B29] border-[#23364A] text-teal-500 shadow-sm focus:ring-2 focus:ring-teal-500/50 focus:ring-offset-0 focus:outline-none w-4 h-4 transition duration-200" name="remember">
                                <span class="ms-2 text-sm text-[#94A3B8] group-hover:text-white transition">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm font-medium text-[#94A3B8] hover:text-white transition-colors" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn-gradient w-full rounded-xl h-[46px] text-center text-sm font-bold text-white focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-[#112235] mt-1">
                            {{ __('Log in') }}
                        </button>

                        <div class="relative my-4">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-[#23364A]"></div>
                            </div>
                            <div class="relative flex justify-center text-xs">
                                <span class="px-3 bg-[#112235] text-[#94A3B8]">{{ __('Or continue with') }}</span>
                            </div>
                        </div>

                        <!-- Google -->
                        <a href="{{ route('auth.google') }}" class="w-full h-[46px] flex items-center justify-center rounded-xl bg-white text-slate-900 font-semibold text-sm transition-all hover:bg-slate-100 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#112235]">
                            <svg class="h-4 w-4 me-2" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            {{ __('Continue with Google') }}
                        </a>

                    </form>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-[#94A3B8] text-xs">
                        {{ __("Don't have an account?") }} 
                        <a href="{{ route('register') }}" class="font-bold text-teal-400 hover:text-teal-300 transition-colors ms-1">{{ __('Sign up') }}</a>
                    </p>
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
