<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-bold text-3xl text-white leading-tight flex items-center gap-3">
                    <div class="bg-indigo-500/20 p-2.5 rounded-xl border border-indigo-500/30">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    {{ __('Job Details & Candidates') }}: <span class="text-indigo-300 font-black">{{ $job->title }}</span>
                </h2>
                <div class="mt-2 text-slate-400 text-sm flex items-center gap-2">
                    <a href="{{ route('company.jobs.index') }}" class="hover:text-white transition flex items-center gap-1 group">
                        <svg class="w-4 h-4 rtl:rotate-180 transform transition-transform group-hover:-translate-x-1 rtl:group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        {{ __('Back to Jobs') }}
                    </a>
                </div>
            </div>
            
            <a href="{{ route('company.jobs.edit', $job) }}" class="group relative px-6 py-2.5 font-bold text-white rounded-xl shadow-xl hover:shadow-indigo-500/25 transition-all duration-300 overflow-hidden flex items-center gap-2 border border-indigo-500/50">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-violet-600 group-hover:opacity-90 transition-opacity"></div>
                <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                <span class="relative z-10">{{ __('Edit Job') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 animate-fade-in-up">
            
            <!-- Job Info Summary (Premium Glassmorphism Card) -->
            <div class="glass-panel p-8 relative overflow-hidden group">
                <!-- Decorative background elements -->
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl group-hover:bg-indigo-500/20 transition-all duration-700"></div>
                <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-violet-500/10 rounded-full blur-3xl group-hover:bg-violet-500/20 transition-all duration-700"></div>
                
                <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-8">
                    <!-- Stats Grid -->
                    <div class="w-full lg:w-2/3 grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="bg-slate-800/40 p-4 rounded-2xl border border-slate-700/50 backdrop-blur-sm hover:border-slate-600 transition-colors">
                            <span class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ __('Status') }}
                            </span>
                            @if($job->status === 'open')
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shadow-[0_0_10px_rgba(16,185,129,0.1)]">{{ __('Open') }}</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold bg-rose-500/10 text-rose-400 border border-rose-500/20 shadow-[0_0_10px_rgba(244,63,94,0.1)]">{{ __('Closed') }}</span>
                            @endif
                        </div>
                        
                        <div class="bg-slate-800/40 p-4 rounded-2xl border border-slate-700/50 backdrop-blur-sm hover:border-slate-600 transition-colors">
                            <span class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ __('Type') }}
                            </span>
                            <span class="text-white font-bold text-lg">{{ ucfirst(__($job->type)) }}</span>
                        </div>
                        
                        <div class="bg-slate-800/40 p-4 rounded-2xl border border-slate-700/50 backdrop-blur-sm hover:border-slate-600 transition-colors">
                            <span class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ __('Location') }}
                            </span>
                            <span class="text-white font-bold text-lg">{{ $job->location }}</span>
                        </div>
                        
                        <div class="bg-slate-800/40 p-4 rounded-2xl border border-slate-700/50 backdrop-blur-sm hover:border-slate-600 transition-colors">
                            <span class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <svg class="w-4 h-4 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                {{ __('Vacancies') }}
                            </span>
                            <span class="text-white font-bold text-lg">{{ $job->vacancies }}</span>
                        </div>
                    </div>
                    
                    <!-- Main KPI Box -->
                    <div class="w-full lg:w-1/3">
                        <div class="relative overflow-hidden rounded-3xl p-6 border-2 border-indigo-500/30 bg-gradient-to-br from-indigo-900/40 to-slate-900/60 text-center shadow-[0_0_30px_rgba(79,70,229,0.15)] flex flex-col justify-center items-center h-full">
                            <div class="absolute top-0 right-0 p-4 opacity-10">
                                <svg class="w-24 h-24 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                            </div>
                            <span class="relative z-10 text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400 mb-2">{{ $job->applications->count() }}</span>
                            <span class="relative z-10 text-sm font-bold text-indigo-200 uppercase tracking-widest">{{ __('Total Candidates') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Candidates List Area -->
            <div x-data="{ viewMode: 'kanban' }">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <h3 class="text-2xl font-black text-white flex items-center gap-3">
                        <span class="bg-indigo-500 text-white p-2 rounded-lg shadow-lg shadow-indigo-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </span>
                        {{ __('Nominated Candidates') }}
                    </h3>

                    <!-- View Switcher Tabs (Kanban vs List) -->
                    <div class="bg-slate-900 p-1 rounded-xl border border-slate-800 flex items-center gap-1 shadow-inner">
                        <button @click="viewMode = 'kanban'" :class="viewMode === 'kanban' ? 'bg-indigo-600 text-white font-bold shadow-md' : 'text-slate-400 hover:text-white font-medium'" class="px-4 py-2 rounded-lg text-xs transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
                            <span>{{ __('Kanban Board') }}</span>
                        </button>
                        <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-indigo-600 text-white font-bold shadow-md' : 'text-slate-400 hover:text-white font-medium'" class="px-4 py-2 rounded-lg text-xs transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            <span>{{ __('List View') }}</span>
                        </button>
                    </div>
                </div>

                <!-- KANBAN BOARD VIEW -->
                <div x-show="viewMode === 'kanban'" class="grid grid-cols-1 lg:grid-cols-5 gap-4">
                    <!-- Column 1: Under Review (تحت المراجعة) -->
                    <div class="glass-panel p-4 border-t-4 border-t-amber-500 flex flex-col h-full min-h-[450px]">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-800">
                            <h4 class="font-bold text-amber-400 text-xs flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                {{ __('Under Review') }}
                            </h4>
                            <span class="text-xs font-mono font-bold bg-amber-500/10 text-amber-400 px-2 py-0.5 rounded-full border border-amber-500/20">
                                {{ $job->applications->where('status', 'pending')->count() }}
                            </span>
                        </div>

                        <div class="space-y-4 flex-grow">
                            @forelse($job->applications->where('status', 'pending') as $application)
                                @php $candidate = $application->user; @endphp
                                <div class="bg-slate-900/90 border border-slate-800 rounded-xl p-3 shadow-lg hover:border-amber-500/40 transition">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-amber-500 to-indigo-600 text-white font-bold flex items-center justify-center text-xs shadow-md">
                                            {{ mb_substr($candidate->first_name, 0, 1, 'UTF-8') }}
                                        </div>
                                        <div class="min-w-0">
                                            <h5 class="font-bold text-white text-xs truncate">{{ $candidate->name }}</h5>
                                            <span class="text-[10px] text-slate-400 block truncate">{{ $candidate->headline ?: __('Candidate') }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1.5 pt-2 border-t border-slate-800/80">
                                        <form action="{{ route('company.applications.status', $application) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="interview">
                                            <button type="submit" class="w-full bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white border border-indigo-500/30 py-1 rounded text-[10px] font-bold transition flex items-center justify-center gap-1">
                                                {{ __('Interview') }}
                                            </button>
                                        </form>
                                        <form action="{{ route('company.applications.status', $application) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-full bg-rose-600/20 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-500/30 py-1 rounded text-[10px] font-bold transition flex items-center justify-center gap-1">
                                                {{ __('Reject') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-slate-500 text-xs">
                                    {{ __('No pending candidates') }}
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Column 2: Interview (مقابلة شخصية) -->
                    <div class="glass-panel p-4 border-t-4 border-t-purple-500 flex flex-col h-full min-h-[450px]">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-800">
                            <h4 class="font-bold text-purple-400 text-xs flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                {{ __('Interview') }}
                            </h4>
                            <span class="text-xs font-mono font-bold bg-purple-500/10 text-purple-400 px-2 py-0.5 rounded-full border border-purple-500/20">
                                {{ $job->applications->where('status', 'interview')->count() }}
                            </span>
                        </div>

                        <div class="space-y-4 flex-grow">
                            @forelse($job->applications->where('status', 'interview') as $application)
                                @php $candidate = $application->user; @endphp
                                <div class="bg-slate-900/90 border border-slate-800 rounded-xl p-3 shadow-lg hover:border-purple-500/40 transition">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-8 h-8 rounded-lg bg-purple-600 text-white font-bold flex items-center justify-center text-xs shadow-md">
                                            {{ mb_substr($candidate->first_name, 0, 1, 'UTF-8') }}
                                        </div>
                                        <div class="min-w-0">
                                            <h5 class="font-bold text-white text-xs truncate">{{ $candidate->name }}</h5>
                                            <span class="text-[10px] text-purple-300 block font-semibold truncate">{{ __('Interview Scheduled') }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1.5 pt-2 border-t border-slate-800/80">
                                        <form action="{{ route('company.applications.status', $application) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="shortlisted">
                                            <button type="submit" class="w-full bg-cyan-600/20 hover:bg-cyan-600 text-cyan-400 hover:text-white border border-cyan-500/30 py-1 rounded text-[10px] font-bold transition flex items-center justify-center gap-1">
                                                {{ __('Shortlist') }}
                                            </button>
                                        </form>
                                        <form action="{{ route('company.applications.status', $application) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-full bg-rose-600/20 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-500/30 py-1 rounded text-[10px] font-bold transition flex items-center justify-center gap-1">
                                                {{ __('Reject') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-slate-500 text-xs">
                                    {{ __('No interviews scheduled') }}
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Column 3: Shortlisted (قبول مبدئي) -->
                    <div class="glass-panel p-4 border-t-4 border-t-cyan-500 flex flex-col h-full min-h-[450px]">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-800">
                            <h4 class="font-bold text-cyan-400 text-xs flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-cyan-500"></span>
                                {{ __('Shortlisted') }}
                            </h4>
                            <span class="text-xs font-mono font-bold bg-cyan-500/10 text-cyan-400 px-2 py-0.5 rounded-full border border-cyan-500/20">
                                {{ $job->applications->where('status', 'shortlisted')->count() }}
                            </span>
                        </div>

                        <div class="space-y-4 flex-grow">
                            @forelse($job->applications->where('status', 'shortlisted') as $application)
                                @php $candidate = $application->user; @endphp
                                <div class="bg-slate-900/90 border border-slate-800 rounded-xl p-3 shadow-lg hover:border-cyan-500/40 transition">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-8 h-8 rounded-lg bg-cyan-600 text-white font-bold flex items-center justify-center text-xs shadow-md">
                                            {{ mb_substr($candidate->first_name, 0, 1, 'UTF-8') }}
                                        </div>
                                        <div class="min-w-0">
                                            <h5 class="font-bold text-white text-xs truncate">{{ $candidate->name }}</h5>
                                            <span class="text-[10px] text-cyan-300 block font-semibold truncate">{{ __('Shortlisted') }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1.5 pt-2 border-t border-slate-800/80">
                                        <form action="{{ route('company.applications.status', $application) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="w-full bg-emerald-600/20 hover:bg-emerald-600 text-emerald-400 hover:text-white border border-emerald-500/30 py-1 rounded text-[10px] font-bold transition flex items-center justify-center gap-1">
                                                {{ __('Accept') }}
                                            </button>
                                        </form>
                                        <form action="{{ route('company.applications.status', $application) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-full bg-rose-600/20 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-500/30 py-1 rounded text-[10px] font-bold transition flex items-center justify-center gap-1">
                                                {{ __('Reject') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-slate-500 text-xs">
                                    {{ __('No shortlisted candidates') }}
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Column 4: Accepted (قبول نهائي) -->
                    <div class="glass-panel p-4 border-t-4 border-t-emerald-500 flex flex-col h-full min-h-[450px]">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-800">
                            <h4 class="font-bold text-emerald-400 text-xs flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                {{ __('Accepted') }}
                            </h4>
                            <span class="text-xs font-mono font-bold bg-emerald-500/10 text-emerald-400 px-2 py-0.5 rounded-full border border-emerald-500/20">
                                {{ $job->applications->where('status', 'accepted')->count() }}
                            </span>
                        </div>

                        <div class="space-y-4 flex-grow">
                            @forelse($job->applications->where('status', 'accepted') as $application)
                                @php $candidate = $application->user; @endphp
                                <div class="bg-slate-900/90 border border-emerald-500/30 rounded-xl p-3 shadow-lg">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white font-bold flex items-center justify-center text-xs shadow-md">
                                            {{ mb_substr($candidate->first_name, 0, 1, 'UTF-8') }}
                                        </div>
                                        <div class="min-w-0">
                                            <h5 class="font-bold text-white text-xs truncate">{{ $candidate->name }}</h5>
                                            <span class="text-[10px] text-emerald-300 block font-semibold truncate">{{ __('Hired') }}</span>
                                        </div>
                                    </div>
                                    <div class="text-[10px] text-slate-400 space-y-0.5 mb-2">
                                        <div class="truncate"><span class="text-slate-500">{{ __('Phone') }}:</span> {{ $candidate->phone }}</div>
                                    </div>
                                    @if($candidate->resumes->count() > 0)
                                        <a href="{{ route('resumes.download', $candidate->resumes->first()) }}" target="_blank" class="w-full bg-indigo-600/20 hover:bg-indigo-600 text-indigo-300 hover:text-white border border-indigo-500/30 py-1 rounded text-[10px] font-bold transition flex items-center justify-center gap-1">
                                            {{ __('Download CV') }}
                                        </a>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-12 text-slate-500 text-xs">
                                    {{ __('No accepted candidates yet') }}
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Column 5: Rejected (مرفوض / أرشيف) -->
                    <div class="glass-panel p-4 border-t-4 border-t-rose-500 flex flex-col h-full min-h-[450px]">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-800">
                            <h4 class="font-bold text-rose-400 text-xs flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                {{ __('Rejected') }}
                            </h4>
                            <span class="text-xs font-mono font-bold bg-rose-500/10 text-rose-400 px-2 py-0.5 rounded-full border border-rose-500/20">
                                {{ $job->applications->where('status', 'rejected')->count() }}
                            </span>
                        </div>

                        <div class="space-y-4 flex-grow">
                            @forelse($job->applications->where('status', 'rejected') as $application)
                                @php $candidate = $application->user; @endphp
                                <div class="bg-slate-900/60 border border-slate-800 rounded-xl p-3 opacity-75">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-8 h-8 rounded-lg bg-slate-800 text-slate-400 font-bold flex items-center justify-center text-xs border border-slate-700">
                                            {{ mb_substr($candidate->first_name, 0, 1, 'UTF-8') }}
                                        </div>
                                        <div class="min-w-0">
                                            <h5 class="font-bold text-slate-400 text-xs line-through truncate">{{ $candidate->name }}</h5>
                                            <span class="text-[10px] text-rose-400 block font-semibold truncate">{{ __('Rejected') }}</span>
                                        </div>
                                    </div>
                                    <div class="pt-2 border-t border-slate-800/80">
                                        <form action="{{ route('company.applications.status', $application) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="w-full bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 py-1 rounded text-[10px] font-bold transition flex items-center justify-center gap-1">
                                                {{ __('Reset Status') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-slate-500 text-xs">
                                    {{ __('No archived candidates') }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- LIST VIEW -->
                <div x-show="viewMode === 'list'" class="grid grid-cols-1 gap-6">
                    @forelse($job->applications as $application)
                        @php $candidate = $application->user; @endphp
                        <div class="glass-panel p-6 flex flex-col xl:flex-row gap-6 items-center hover:-translate-y-1 transition-all duration-300 hover:shadow-[0_10px_30px_rgba(79,70,229,0.15)] group relative overflow-hidden">
                            <!-- Subtle highlight on hover -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-indigo-500/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

                            <!-- Avatar & Name Section -->
                            <div class="flex items-center gap-5 w-full xl:w-1/4 z-10 border-b xl:border-b-0 xl:ltr:border-r xl:rtl:border-l border-slate-700/50 pb-6 xl:pb-0 xl:ltr:pr-6 xl:rtl:pl-6">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-cyan-500 text-white flex items-center justify-center text-2xl font-black shadow-lg shadow-indigo-500/30 transform group-hover:rotate-6 transition-transform">
                                        {{ mb_substr($candidate->first_name, 0, 1) }}
                                    </div>
                                    <div class="absolute -bottom-2 -right-2 bg-emerald-500 w-5 h-5 border-2 border-slate-900 rounded-full" title="Verified"></div>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white group-hover:text-indigo-300 transition-colors">{{ $candidate->name }}</h4>
                                    <p class="text-sm text-cyan-400 font-semibold mt-1">{{ $candidate->headline ?: __('Not Specified') }}</p>
                                </div>
                            </div>
                            
                            <!-- Detailed Info Grid -->
                            <div class="flex-grow grid grid-cols-1 md:grid-cols-3 gap-6 w-full z-10 rtl:text-right ltr:text-left">
                                <!-- Exp & Edu -->
                                <div class="space-y-4">
                                    <div>
                                        <span class="flex items-center gap-1.5 text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            {{ __('Experience') }}
                                        </span>
                                        <span class="text-slate-200 font-medium bg-slate-800/50 px-3 py-1.5 rounded-lg border border-slate-700/50 inline-block">{{ $candidate->years_of_experience ?: __('Not Specified') }}</span>
                                    </div>
                                    <div>
                                        <span class="flex items-center gap-1.5 text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                            {{ __('Education') }}
                                        </span>
                                        <span class="text-slate-200 font-medium bg-slate-800/50 px-3 py-1.5 rounded-lg border border-slate-700/50 inline-block truncate max-w-full" title="{{ $candidate->education_degree }}">{{ $candidate->education_degree ?: __('Not Specified') }}</span>
                                    </div>
                                </div>

                                <!-- Location & Phone & Email -->
                                <div class="space-y-3">
                                    <div>
                                        <span class="flex items-center gap-1.5 text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ __('Location') }}
                                        </span>
                                        <span class="text-slate-200 font-medium">{{ $candidate->location }}</span>
                                    </div>
                                    <div>
                                        <span class="flex items-center gap-1.5 text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            {{ __('Phone') }}
                                        </span>
                                        @if($candidate->phone)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $candidate->phone) }}" target="_blank" class="text-emerald-400 hover:text-emerald-300 hover:underline font-semibold text-sm transition-colors block" dir="ltr" title="{{ __('Chat on WhatsApp') }}">{{ $candidate->phone }}</a>
                                        @else
                                            <span class="text-slate-400 font-medium">{{ __('Not Specified') }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="flex items-center gap-1.5 text-slate-500 text-xs font-bold uppercase mb-1">
                                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            {{ __('Email') }}
                                        </span>
                                        <a href="mailto:{{ $candidate->email }}" class="text-sky-400 hover:underline font-medium block truncate max-w-full" dir="ltr" title="{{ $candidate->email }}">{{ $candidate->email }}</a>
                                    </div>
                                </div>

                                <!-- Skills -->
                                <div>
                                    <span class="flex items-center gap-1.5 text-slate-500 text-xs font-bold uppercase mb-2">
                                        <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        {{ __('Skills') }}
                                    </span>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($candidate->userSkills->take(4) as $userSkill)
                                            <span class="text-xs font-semibold bg-indigo-500/10 text-indigo-300 px-2.5 py-1 rounded-md border border-indigo-500/20 shadow-sm">{{ $userSkill->skill->name }}</span>
                                        @endforeach
                                        @if($candidate->userSkills->count() > 4)
                                            <span class="text-xs font-bold text-slate-400 bg-slate-800 px-2.5 py-1 rounded-md border border-slate-700">+{{ $candidate->userSkills->count() - 4 }}</span>
                                        @endif
                                        @if($candidate->userSkills->count() == 0)
                                            <span class="text-xs text-slate-500">{{ __('No skills listed.') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Actions (CV & LinkedIn & Feedback) -->
                            <div class="flex flex-col gap-3 w-full xl:w-[220px] z-10 border-t xl:border-t-0 xl:ltr:border-l xl:rtl:border-r border-slate-700/50 pt-6 xl:pt-0 xl:ltr:pl-6 xl:rtl:pr-6">
                                
                                <!-- Application Status / Feedback -->
                                <div class="bg-slate-800/50 rounded-xl p-3 border border-slate-700/50 mb-1">
                                    <span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-2 text-center">{{ __('Candidate Status') }}</span>
                                    <form action="{{ route('company.applications.status', $application) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="if(this.value==='interview'){window.dispatchEvent(new CustomEvent('open-modal',{detail:'interview-{{ $application->id }}'})); this.value='{{ $application->status }}';} else { this.form.submit(); }" class="w-full bg-[#081B29] border border-slate-700 rounded-lg text-xs text-slate-300 py-1.5 focus:outline-none focus:border-indigo-500">
                                            <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>{{ __('Under Review') }}</option>
                                            <option value="interview" {{ $application->status === 'interview' ? 'selected' : '' }}>{{ __('Interview') }}</option>
                                            <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>{{ __('Shortlisted') }}</option>
                                            <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>{{ __('Accepted') }}</option>
                                            <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>{{ __('Rejected') }}</option>
                                        </select>
                                    </form>

                                    @if($application->interview)
                                        <div class="mt-2 pt-2 border-t border-slate-700/50 text-[10px] text-slate-400 space-y-0.5">
                                            <div class="font-bold text-indigo-300">{{ $application->interview->type === 'online' ? __('Online Interview') : __('In-Person Interview') }}</div>
                                            <div>{{ $application->interview->scheduled_at->translatedFormat('d M Y — h:i A') }}</div>
                                        </div>
                                    @endif

                                    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'interview-{{ $application->id }}')" class="mt-2 w-full text-[10px] font-bold text-indigo-400 hover:text-indigo-300 underline underline-offset-2">
                                        {{ $application->interview ? __('Reschedule Interview') : __('Schedule Interview') }}
                                    </button>
                                </div>

                                <x-modal name="interview-{{ $application->id }}" maxWidth="md">
                                    <form action="{{ route('company.applications.interview', $application) }}" method="POST" class="p-6" x-data="{ type: '{{ $application->interview->type ?? 'online' }}' }">
                                        @csrf
                                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            {{ __('Schedule Interview') }} — {{ $candidate->name }}
                                        </h2>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            {{ __('The candidate will receive an email with these details.') }}
                                        </p>

                                        <div class="mt-4 grid grid-cols-2 gap-4">
                                            <div>
                                                <x-input-label for="interview_date_{{ $application->id }}" value="{{ __('Date') }}" />
                                                <x-text-input id="interview_date_{{ $application->id }}" name="interview_date" type="date" class="mt-1 block w-full" min="{{ now()->format('Y-m-d') }}" value="{{ $application->interview?->scheduled_at?->format('Y-m-d') }}" required />
                                            </div>
                                            <div>
                                                <x-input-label for="interview_time_{{ $application->id }}" value="{{ __('Time') }}" />
                                                <x-text-input id="interview_time_{{ $application->id }}" name="interview_time" type="time" class="mt-1 block w-full" value="{{ $application->interview?->scheduled_at?->format('H:i') }}" required />
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <x-input-label value="{{ __('Interview Type') }}" />
                                            <div class="mt-1 flex gap-4">
                                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                                    <input type="radio" name="type" value="online" x-model="type" {{ ($application->interview->type ?? 'online') === 'online' ? 'checked' : '' }}>
                                                    {{ __('Online') }}
                                                </label>
                                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                                    <input type="radio" name="type" value="in-person" x-model="type" {{ ($application->interview->type ?? '') === 'in-person' ? 'checked' : '' }}>
                                                    {{ __('In-Person') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <x-input-label for="location_link_{{ $application->id }}" value="{{ __('Meeting Link') }}" x-text="type === 'online' ? '{{ __('Meeting Link') }}' : '{{ __('Location / Address') }}'" />
                                            <x-text-input id="location_link_{{ $application->id }}" name="location_link" type="text" class="mt-1 block w-full" :placeholder="__('e.g. https://meet.google.com/xyz or the office address')" value="{{ $application->interview->location_link ?? '' }}" required />
                                        </div>

                                        <div class="mt-4">
                                            <x-input-label for="notes_{{ $application->id }}" value="{{ __('Additional Notes (optional)') }}" />
                                            <textarea id="notes_{{ $application->id }}" name="notes" rows="2" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">{{ $application->interview->notes ?? '' }}</textarea>
                                        </div>

                                        <div class="mt-6 flex justify-end gap-3">
                                            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>
                                            <x-primary-button>
                                                {{ __('Schedule & Notify Candidate') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </x-modal>

                                @if($application->resume_id && $candidate->resumes->where('id', $application->resume_id)->first())
                                    <a href="{{ route('resumes.download', $candidate->resumes->where('id', $application->resume_id)->first()) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-500 to-cyan-500 hover:from-indigo-400 hover:to-cyan-400 text-white shadow-[0_4px_15px_rgba(99,102,241,0.3)] hover:shadow-[0_6px_20px_rgba(99,102,241,0.4)] px-5 py-2.5 rounded-xl text-sm font-bold transition-all transform hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        {{ __('View CV') }}
                                    </a>
                                @elseif($candidate->resumes->count() > 0)
                                    <a href="{{ route('resumes.download', $candidate->resumes->sortByDesc('created_at')->first()) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-500 to-cyan-500 hover:from-indigo-400 hover:to-cyan-400 text-white shadow-[0_4px_15px_rgba(99,102,241,0.3)] hover:shadow-[0_6px_20px_rgba(99,102,241,0.4)] px-5 py-2.5 rounded-xl text-sm font-bold transition-all transform hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        {{ __('View CV') }}
                                    </a>
                                @else
                                    <span class="w-full flex items-center justify-center gap-2 bg-slate-800/80 text-slate-400 px-5 py-2.5 rounded-xl text-sm font-bold border border-slate-700/50 cursor-not-allowed">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                        {{ __('No CV attached') }}
                                    </span>
                                @endif
                                
                                @if($candidate->linkedin_url)
                                    <a href="{{ $candidate->linkedin_url }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-[#0a66c2]/10 hover:bg-[#0a66c2]/20 text-[#3b8fd8] border border-[#0a66c2]/30 px-5 py-2 rounded-xl text-sm font-bold transition-colors">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                        {{ __('LinkedIn Profile') }}
                                    </a>
                                @endif


                            </div>
                        </div>
                    @empty
                        <div class="glass-panel p-12 text-center flex flex-col items-center justify-center min-h-[300px]">
                            <div class="w-24 h-24 bg-slate-800/50 rounded-full flex items-center justify-center mb-6 border-2 border-dashed border-slate-600">
                                <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h4 class="text-2xl font-bold text-white mb-2">{{ __('No candidates nominated yet') }}</h4>
                            <p class="text-slate-400 max-w-md">{{ __('The administration team will review your requirement and nominate suitable candidates soon.') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
