<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Posted Requirements / Jobs') }}
        </h2>
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
                                <th class="p-4 font-semibold">{{ __('Company Name') }}</th>
                                <th class="p-4 font-semibold">{{ __('Job Title') }}</th>
                                <th class="p-4 font-semibold">{{ __('Type') }}</th>
                                <th class="p-4 font-semibold">{{ __('Vacancies') }}</th>
                                <th class="p-4 font-semibold">{{ __('Status') }}</th>
                                <th class="p-4 font-semibold text-right">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse($jobs as $job)
                            <tr class="hover:bg-slate-800/30 transition duration-150">
                                <td class="p-4 font-medium text-white">{{ optional($job->company)->name }}</td>
                                <td class="p-4 text-slate-300">{{ $job->title }}</td>
                                <td class="p-4 text-slate-300">{{ ucfirst($job->type) }}</td>
                                <td class="p-4 text-slate-300">{{ $job->vacancies }}</td>
                                <td class="p-4">
                                    @if($job->status === 'open')
                                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">{{ __('Open') }}</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">{{ __('Closed') }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-right flex justify-end space-x-3 items-center">
                                    <a href="{{ route('admin.jobs.show', $job) }}" class="text-sky-400 hover:text-sky-300 transition" title="{{ __('View Details') }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this job?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-400 hover:text-rose-300 transition" title="{{ __('Delete Job') }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400">
                                    {{ __('No jobs found.') }}
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
