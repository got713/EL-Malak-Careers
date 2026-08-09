<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('My Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Sidebar User Summary -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-8 flex flex-col items-center text-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center text-4xl font-bold shadow-lg mb-6 ring-4 ring-blue-50 dark:ring-blue-900/30">
                            {{ mb_substr(auth()->user()->first_name ?? '', 0, 1, 'UTF-8') }}{{ mb_substr(auth()->user()->last_name ?? '', 0, 1, 'UTF-8') }}
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">{{ auth()->user()->email }}</p>
                        
                        <div class="mt-6 w-full pt-6 border-t border-slate-100 dark:border-slate-700">
                            <div class="inline-flex items-center justify-center px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-sm font-semibold rounded-full border border-blue-100 dark:border-blue-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ auth()->user()->hasRole('company') ? __('Company Account') : __('Job Seeker Account') }}
                            </div>
                        </div>

                        @if(!auth()->user()->hasRole('company'))
                        <div class="mt-4 w-full">
                            <a href="{{ route('profile.cvBuilder') }}" target="_blank" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition shadow-lg flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span>{{ __('Generate & Print Professional CV') }}</span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Main Forms -->
                <div class="md:col-span-2 space-y-8">
                    
                    <!-- Profile Information -->
                    <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 transition-all duration-300 hover:shadow-md relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-2 h-full bg-blue-500 transform origin-bottom transition-transform duration-300"></div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 transition-all duration-300 hover:shadow-md relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-2 h-full bg-indigo-500 transform origin-bottom transition-transform duration-300"></div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Delete Account -->
                    <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-red-100 dark:border-red-900/50 transition-all duration-300 hover:shadow-md relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-2 h-full bg-red-500 transform origin-bottom transition-transform duration-300"></div>
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
