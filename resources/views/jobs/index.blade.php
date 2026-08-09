<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Search Section -->
            <div class="glass-card rounded-2xl p-8 mb-10 text-center relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 to-sky-500/20 opacity-0 group-hover:opacity-100 transition duration-700"></div>
                <h1 class="text-4xl font-extrabold mb-4 text-white">Find Your <span class="gradient-text">Dream Job</span> Today</h1>
                <p class="text-slate-300 mb-8 max-w-2xl mx-auto">Discover thousands of job opportunities tailored to your skills and preferences. Start your journey with Malak Careers.</p>
                
                <form action="{{ route('home') }}" method="GET" class="relative max-w-3xl mx-auto">
                    <div class="flex items-center glass p-2 rounded-full border border-slate-700 hover:border-indigo-500/50 transition duration-300 shadow-lg">
                        <svg class="w-6 h-6 text-slate-400 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by job title, keyword, or company..." class="w-full bg-transparent border-none text-white focus:ring-0 placeholder-slate-400 px-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-full font-semibold transition duration-300 shadow-[0_0_15px_rgba(79,70,229,0.5)] hover:shadow-[0_0_25px_rgba(79,70,229,0.7)]">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Job Listings -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Latest Opportunities</h2>
                <div class="text-slate-400 text-sm">Showing {{ $jobs->firstItem() ?? 0 }}-{{ $jobs->lastItem() ?? 0 }} of {{ $jobs->total() }} jobs</div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($jobs as $job)
                    <div class="glass-card rounded-xl p-6 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(56,189,248,0.15)] transition duration-300 flex flex-col h-full border border-slate-700/50 hover:border-sky-500/50 group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-500 to-sky-500 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                    {{ substr($job->company->name ?? 'C', 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="text-white font-semibold group-hover:text-sky-400 transition">{{ $job->title }}</h3>
                                    <p class="text-sm text-slate-400">{{ $job->company->name ?? 'Unknown Company' }}</p>
                                </div>
                            </div>
                            @auth
                            <button class="text-slate-500 hover:text-rose-500 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                            @endauth
                        </div>
                        
                        <div class="mt-2 mb-4 flex-grow">
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">{{ ucfirst($job->type) }}</span>
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">{{ $job->location }}</span>
                            </div>
                            <p class="text-slate-400 text-sm line-clamp-3">{{ $job->description }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-slate-800">
                            <span class="text-sm font-semibold text-slate-300">{{ $job->salary_range ?? 'Salary Negotiable' }}</span>
                            <a href="{{ route('jobs.show', $job) }}" class="text-sm font-medium text-sky-400 hover:text-sky-300 transition flex items-center">
                                View Details 
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full glass-card rounded-2xl p-12 text-center">
                        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-xl font-medium text-slate-300 mb-2">No jobs found</h3>
                        <p class="text-slate-500">Try adjusting your search keywords or come back later for new opportunities.</p>
                        @if(request('search'))
                            <a href="{{ route('home') }}" class="mt-4 inline-block text-indigo-400 hover:text-indigo-300">Clear Search</a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
