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
        <style>
            [x-cloak] { display: none !important; }
            .input-premium {
                width: 100%;
                border-radius: 0.75rem !important;
                border: 1px solid #334155 !important;
                background-color: #0f172a !important;
                color: #ffffff !important;
                padding: 0.625rem 1rem !important;
                font-size: 0.875rem !important;
                transition: all 0.2s ease !important;
            }
            .input-premium:focus {
                border-color: #14b8a6 !important;
                outline: none !important;
                box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.2) !important;
            }
        </style>
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
    <body class="font-sans antialiased text-slate-900 dark:text-slate-100 flex flex-col selection:bg-teal-500 selection:text-white relative overflow-x-hidden">
        <!-- Background Elements -->
        <div class="fixed inset-0 z-[-1] overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
            <div class="absolute -top-[40%] -left-[10%] w-[70%] h-[70%] rounded-full bg-teal-400/10 dark:bg-teal-600/5 blur-3xl"></div>
            <div class="absolute top-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-emerald-400/10 dark:bg-emerald-600/5 blur-3xl"></div>
            <div class="absolute -bottom-[20%] left-[20%] w-[80%] h-[80%] rounded-full bg-amber-400/10 dark:bg-amber-600/5 blur-3xl"></div>
        </div>

        <div class="min-h-screen flex flex-col w-full z-10">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="glass shadow mt-16">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @else
            <div class="mt-16"></div>
        @endif

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>
        
        <!-- Footer -->
        <footer class="mt-auto bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-center items-center text-slate-500 dark:text-slate-400">
                    <div class="mb-4 md:mb-0 text-center">
                        <p>&copy; {{ date('Y') }} {{ __('Malak Careers. All rights reserved.') }}</p>
                    </div>
                </div>
            </div>
        </footer>
        </div>

        <!-- Toast Notification Component -->
        <div x-data="{ show: false, message: '', type: 'success' }" 
             x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => { show = false }, 3000)"
             class="fixed bottom-5 right-5 z-50 transition-all duration-500 transform"
             x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             style="display: none;">
            <div :class="{
                'bg-emerald-500': type === 'success',
                'bg-red-500': type === 'error',
                'bg-blue-500': type === 'info'
            }" class="rounded-lg shadow-lg text-white p-4 flex items-center gap-3">
                <svg x-show="type === 'success'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <svg x-show="type === 'error'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <span x-text="message" class="font-semibold"></span>
            </div>
        </div>

        <!-- Session Flash Data to Alpine Event -->
        @if (session()->has('success'))
            <script>
                document.addEventListener('alpine:init', () => {
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('notify', { detail: { message: '{{ session('success') }}', type: 'success' } }));
                    }, 500);
                });
            </script>
        @endif
        @if (session()->has('error'))
            <script>
                document.addEventListener('alpine:init', () => {
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('notify', { detail: { message: '{{ session('error') }}', type: 'error' } }));
                    }, 500);
                });
            </script>
        @endif

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

        @stack('scripts')
    </body>
</html>
