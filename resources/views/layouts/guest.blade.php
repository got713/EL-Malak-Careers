<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Malak Careers') }}</title>

        <!-- Fonts & Tailwind CDN -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <style>[x-cloak] { display: none !important; }</style>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Cairo', 'Outfit', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans text-slate-900 dark:text-slate-100 antialiased selection:bg-teal-500 selection:text-white overflow-hidden bg-white dark:bg-slate-900">
        
        <div class="h-screen flex flex-col justify-center items-center relative w-full overflow-hidden">
            
            <!-- Background Image & Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Career and Talent Background" class="w-full h-full object-cover opacity-10 dark:opacity-20 mix-blend-overlay">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-100/95 via-slate-50/95 to-slate-200/90 dark:from-slate-900/95 dark:via-slate-900/98 dark:to-teal-950/90 backdrop-blur-sm"></div>
            </div>
            
            <!-- Language Switcher -->
            <div class="absolute top-6 right-6 z-50 flex items-center rtl:flex-row-reverse animate-fade-in-down">
                @if(app()->getLocale() == 'en')
                    <a href="{{ route('lang.switch', 'ar') }}" class="flex items-center space-x-2 rtl:space-x-reverse px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-teal-50 dark:hover:bg-teal-900/30 hover:text-teal-600 dark:hover:text-teal-400 transition-all duration-300 font-medium text-sm border border-transparent hover:border-teal-200 dark:hover:border-teal-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>العربية</span>
                    </a>
                @else
                    <a href="{{ route('lang.switch', 'en') }}" class="flex items-center space-x-2 rtl:space-x-reverse px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-teal-50 dark:hover:bg-teal-900/30 hover:text-teal-600 dark:hover:text-teal-400 transition-all duration-300 font-medium text-sm border border-transparent hover:border-teal-200 dark:hover:border-teal-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>English</span>
                    </a>
                @endif
            </div>

            <!-- Content Container -->
            <div class="relative z-10 w-full {{ request()->routeIs('register', 'company.register') ? 'max-w-2xl' : 'max-w-[480px]' }} px-4 py-4 flex flex-col items-center">
                
                <!-- Form Card -->
                <div class="w-full glass-panel bg-white/90 dark:bg-slate-900/75 backdrop-blur-[12px] rounded-2xl shadow-2xl p-6 sm:p-8 border border-slate-200/50 dark:border-white/10 flex flex-col items-center">
                    
                    <!-- Branding -->
                    <div class="w-full flex flex-col items-center text-center mb-6">
                        <a href="/" class="group inline-block">
                            <img src="{{ asset('images/logo.svg') }}" alt="Malak Careers Logo" class="h-auto w-40 md:w-48 block dark:hidden drop-shadow-lg group-hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('images/logo.svg') }}" alt="Malak Careers Logo" class="h-auto w-40 md:w-48 hidden dark:block drop-shadow-2xl group-hover:scale-105 transition-transform duration-300 filter brightness-0 invert">
                        </a>
                    </div>

                    <div class="w-full">
                        {{ $slot }}
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- Prevent inspect element and right click -->
        <script>
            document.addEventListener('contextmenu', event => event.preventDefault());
            document.addEventListener('keydown', function(event) {
                if (event.keyCode === 123) {
                    event.preventDefault();
                    return false;
                }
                if (event.ctrlKey && event.shiftKey && event.keyCode === 73) {
                    event.preventDefault();
                    return false;
                }
                if (event.ctrlKey && event.shiftKey && event.keyCode === 74) {
                    event.preventDefault();
                    return false;
                }
                if (event.ctrlKey && event.keyCode === 85) {
                    event.preventDefault();
                    return false;
                }
            });
        </script>
    </body>
</html>
