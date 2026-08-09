<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('home') }}" class="text-slate-400 hover:text-white transition flex items-center inline-flex">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Jobs
                </a>
            </div>

            <div class="glass-card rounded-2xl overflow-hidden shadow-2xl relative">
                <!-- Header Banner -->
                <div class="h-32 bg-gradient-to-r from-indigo-600/80 to-sky-500/80 relative">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-30 mix-blend-overlay"></div>
                </div>
                
                <div class="px-8 pb-8 relative">
                    <!-- Company Logo & Action Buttons -->
                    <div class="flex justify-between items-start -mt-12 mb-6">
                        <div class="w-24 h-24 rounded-xl bg-slate-800 border-4 border-slate-900 shadow-xl flex items-center justify-center text-3xl font-bold text-white bg-gradient-to-br from-indigo-500 to-sky-500">
                            {{ substr($job->company->name ?? 'C', 0, 1) }}
                        </div>
                        <div class="flex space-x-3 mt-14">
                            @auth
                                @if(auth()->user()->hasRole('seeker'))
                                    <button class="glass px-4 py-2 rounded-lg text-slate-300 hover:text-rose-500 hover:bg-rose-500/10 hover:border-rose-500/30 transition flex items-center shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        Save
                                    </button>
                                    <form action="#" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-2 rounded-lg font-semibold transition shadow-[0_0_15px_rgba(79,70,229,0.4)] hover:shadow-[0_0_25px_rgba(79,70,229,0.6)]">
                                            Apply Now
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-2 rounded-lg font-semibold transition shadow-lg">Login to Apply</a>
                            @endauth
                        </div>
                    </div>

                    <!-- Job Title & Meta -->
                    <div class="mb-8 border-b border-slate-700/50 pb-8">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $job->title }}</h1>
                        <p class="text-lg text-sky-400 font-medium mb-4">{{ $job->company->name ?? 'Unknown Company' }}</p>
                        
                        <div class="flex flex-wrap gap-4 text-sm text-slate-300">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $job->location }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ ucfirst($job->type) }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Posted {{ $job->created_at->diffForHumans() }}
                            </div>
                            @if($job->salary_range)
                            <div class="flex items-center text-emerald-400">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $job->salary_range }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="md:col-span-2 space-y-8">
                            <!-- Description -->
                            <div>
                                <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                                    <span class="w-8 h-8 rounded bg-indigo-500/20 text-indigo-400 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                                    </span>
                                    Job Description
                                </h2>
                                <div class="text-slate-300 leading-relaxed whitespace-pre-line">
                                    {{ $job->description }}
                                </div>
                            </div>

                            <!-- Requirements -->
                            <div>
                                <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                                    <span class="w-8 h-8 rounded bg-sky-500/20 text-sky-400 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </span>
                                    Requirements
                                </h2>
                                <div class="text-slate-300 leading-relaxed whitespace-pre-line">
                                    {{ $job->requirements }}
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar / Company Info -->
                        <div>
                            <div class="glass p-6 rounded-xl border border-slate-700/50">
                                <h3 class="font-bold text-white mb-4 border-b border-slate-700 pb-2">About Company</h3>
                                <p class="text-sm text-slate-300 mb-4">{{ $job->company->description ?? 'No description provided.' }}</p>
                                
                                <ul class="space-y-3 text-sm">
                                    @if($job->company->industry ?? false)
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-slate-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        <span class="text-slate-300">{{ $job->company->industry }}</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
