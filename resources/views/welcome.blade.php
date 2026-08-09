<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CV Collection System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        
        <style>
            body {
                font-family: 'Outfit', sans-serif;
            }
            html[dir="rtl"] body {
                font-family: 'Cairo', sans-serif !important;
            }
            .glass-card {
                background: linear-gradient(145deg, rgba(30, 41, 59, 0.7) 0%, rgba(15, 23, 42, 0.8) 100%);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255,255,255,0.08);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            }
            .gradient-text {
                background: linear-gradient(to right, #38bdf8, #818cf8);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center selection:bg-indigo-500 selection:text-white relative">
        
        <!-- Language Switcher -->
        <div class="fixed top-6 right-6 z-50 flex space-x-2 rtl:space-x-reverse">
            @if(app()->getLocale() == 'en')
                <a href="{{ route('lang.switch', 'ar') }}" class="px-3 py-1 rounded-md bg-slate-800 text-sm font-medium text-slate-300 hover:text-white border border-slate-700 hover:border-slate-500 transition">العربية</a>
            @else
                <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded-md bg-slate-800 text-sm font-medium text-slate-300 hover:text-white border border-slate-700 hover:border-slate-500 transition">English</a>
            @endif
        </div>
        
        <!-- Background Effects -->
        <div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden">
            <div class="absolute top-[-20%] left-[-10%] w-[500px] h-[500px] bg-indigo-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-20"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-sky-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 w-full">
            <div class="mb-12">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 tracking-tight text-white">
                    {{ __('Welcome to') }} <br /> <span class="gradient-text">{{ __('CV Collection') }}</span>
                </h1>
                <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                    {{ __('Submit your details and upload your resume to be reviewed by our administration team. Start your journey today!') }}
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-lg font-semibold transition shadow-[0_0_20px_rgba(79,70,229,0.4)] hover:shadow-[0_0_30px_rgba(79,70,229,0.6)] flex items-center justify-center group">
                        {{ __('Go to Dashboard') }}
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-4 glass-card hover:bg-slate-800 border-indigo-500/30 hover:border-indigo-500/50 text-indigo-300 hover:text-white rounded-xl text-lg font-semibold transition shadow-lg flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        {{ __('Log In') }}
                    </a>
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-4 bg-gradient-to-r from-indigo-600 to-sky-500 hover:from-indigo-500 hover:to-sky-400 text-white rounded-xl text-lg font-semibold transition shadow-[0_0_25px_rgba(14,165,233,0.4)] hover:shadow-[0_0_35px_rgba(14,165,233,0.6)] flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        {{ __('Create Account') }}
                    </a>
                @endauth
            </div>
            
            <div class="mt-20 text-slate-500 text-sm">
                &copy; {{ date('Y') }} CV Collection System. All rights reserved.
            </div>
        </div>
    </body>
</html>
