<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('My Requirements (Jobs)') }}
            </h2>
            <a href="{{ route('company.jobs.create') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                {{ __('Post New Requirement') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-400 px-4 py-3 rounded-xl mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="glass-card rounded-2xl overflow-hidden shadow-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-700/50 text-slate-400">
                                <th class="p-4 font-semibold">{{ __('Job Title') }}</th>
                                <th class="p-4 font-semibold">{{ __('Type') }}</th>
                                <th class="p-4 font-semibold">{{ __('Vacancies') }}</th>
                                <th class="p-4 font-semibold">{{ __('Status') }}</th>
                                <th class="p-4 font-semibold">{{ __('Posted On') }}</th>
                                <th class="p-4 font-semibold text-right">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse($jobs as $job)
                            <tr class="hover:bg-slate-800/30 transition duration-150">
                                <td class="p-4 font-medium text-white">{{ $job->title }}</td>
                                <td class="p-4 text-slate-300">{{ ucfirst($job->type) }}</td>
                                <td class="p-4 text-slate-300">{{ $job->vacancies }}</td>
                                <td class="p-4">
                                    @if($job->status === 'open')
                                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">{{ __('Open') }}</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">{{ __('Closed') }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-slate-400">{{ $job->created_at->format('M d, Y') }}</td>
                                <td class="p-4 text-right flex justify-end space-x-3 rtl:space-x-reverse items-center">
                                    <a href="{{ route('company.jobs.show', $job) }}" class="text-sky-400 hover:text-sky-300 transition" title="{{ __('View Candidates') }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('company.jobs.edit', $job) }}" class="text-indigo-400 hover:text-indigo-300 transition" title="{{ __('Edit') }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400">
                                    {{ __('No jobs posted yet.') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
