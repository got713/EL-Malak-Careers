<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Registered Companies') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <!-- Total Companies -->
                <div class="glass-card rounded-2xl p-6 relative overflow-hidden border border-slate-800/80 hover:border-indigo-500/50 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">{{ __('Total Companies') }}</span>
                            <span class="text-3xl font-extrabold text-white group-hover:scale-105 transition-transform inline-block">{{ number_format($totalCompaniesCount ?? 0) }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Approval -->
                <div class="glass-card rounded-2xl p-6 relative overflow-hidden border border-slate-800/80 hover:border-rose-500/50 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">{{ __('Pending Companies') }}</span>
                            <span class="text-3xl font-extrabold text-rose-500 group-hover:scale-105 transition-transform inline-block">{{ number_format($pendingCompaniesCount ?? 0) }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Verified Companies -->
                <div class="glass-card rounded-2xl p-6 relative overflow-hidden border border-slate-800/80 hover:border-emerald-500/50 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">{{ __('Verified Companies') }}</span>
                            <span class="text-3xl font-extrabold text-emerald-400 group-hover:scale-105 transition-transform inline-block">{{ number_format($verifiedCompaniesCount ?? 0) }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-400 px-4 py-3 rounded-xl mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('admin.companies.index') }}" class="glass-card rounded-2xl shadow-xl p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <!-- Search Keyword -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-slate-300 mb-1">{{ __('Search (Name, Industry, Location)') }}</label>
                        <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search...') }}" class="w-full bg-[#081B29]/30 border border-slate-700 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-indigo-500" />
                    </div>

                    <!-- Verification Status Selector -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300 mb-1">{{ __('Verification Status') }}</label>
                        <select id="status" name="status" class="w-full bg-[#081B29] border border-slate-700 rounded-xl px-4 py-2 text-sm text-slate-300 focus:outline-none focus:border-indigo-500">
                            <option value="">{{ __('All Statuses') }}</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                            <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>{{ __('Verified') }}</option>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-lg transition flex-grow">
                            {{ __('Filter') }}
                        </button>
                        <a href="{{ route('admin.companies.index') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-5 py-2 rounded-xl text-sm font-bold shadow-lg transition flex-grow text-center flex items-center justify-center">
                            {{ __('Reset') }}
                        </a>
                    </div>
                </div>
            </form>

            <!-- Companies List -->
            <div class="glass-card rounded-2xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full ltr:text-left rtl:text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-700/50 text-slate-400 bg-slate-800/30 text-sm">
                                <th class="p-4 font-semibold">{{ __('Company Name') }}</th>
                                <th class="p-4 font-semibold">{{ __('Email') }}</th>
                                <th class="p-4 font-semibold">{{ __('Location') }}</th>
                                <th class="p-4 font-semibold">{{ __('Industry') }}</th>
                                <th class="p-4 font-semibold text-center">{{ __('Active Jobs') }}</th>
                                <th class="p-4 font-semibold text-center">{{ __('Status') }}</th>
                                <th class="p-4 font-semibold text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-sm">
                            @forelse($companies as $company)
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg bg-indigo-500/10 text-indigo-400 font-bold flex items-center justify-center border border-indigo-500/20">
                                            {{ mb_substr($company->name, 0, 1, 'UTF-8') }}
                                        </div>
                                        <div>
                                            <span class="block text-white font-medium">{{ $company->name }}</span>
                                            @if($company->website)
                                                <a href="{{ $company->website }}" target="_blank" class="text-xs text-sky-400 hover:underline">{{ __('Visit Website') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-300">
                                    {{ $company->user ? $company->user->email : 'N/A' }}
                                </td>
                                <td class="p-4 text-slate-300">
                                    {{ $company->location }}
                                </td>
                                <td class="p-4 text-slate-300">
                                    {{ $company->industry }}
                                </td>
                                <td class="p-4 text-center text-slate-100 font-medium font-mono">
                                    {{ $company->jobs->count() }}
                                </td>
                                <td class="p-4 text-center">
                                    @if($company->is_verified)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            {{ __('Verified') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20 animate-pulse">
                                            {{ __('Pending') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2">
                                        @if(!$company->is_verified)
                                            <form action="{{ route('admin.companies.verify', $company) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-md">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    {{ __('Approve') }}
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.companies.reject', $company) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-md" title="{{ __('Reject/Unverify Company') }}">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    {{ __('Reject') }}
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this company and all its associated users/jobs?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-rose-600/10 hover:bg-rose-600 text-rose-500 hover:text-white border border-rose-500/20 px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-500">
                                    {{ __('No registered companies found.') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($companies->hasPages())
                    <div class="p-4 bg-slate-900/30 border-t border-slate-800">
                        {{ $companies->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
