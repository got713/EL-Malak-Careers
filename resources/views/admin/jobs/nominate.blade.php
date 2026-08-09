<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Nominate Candidates') }} - {{ $job->title }}
            </h2>
            <a href="{{ route('admin.jobs.show', $job) }}" class="text-slate-400 hover:text-white transition">
                {!! __('&larr; Back to Job') !!}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card rounded-2xl p-6 shadow-2xl">
                <div class="mb-6 border-b border-slate-700/50 pb-6">
                    <h3 class="text-lg font-bold text-white mb-2">{{ __('Job Details Summary') }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div><span class="text-slate-400 block">{{ __('Company') }}</span><span class="text-slate-100 font-medium">{{ optional($job->company)->name }}</span></div>
                        <div><span class="text-slate-400 block">{{ __('Type') }}</span><span class="text-slate-100 font-medium">{{ ucfirst($job->type) }}</span></div>
                        <div><span class="text-slate-400 block">{{ __('Location') }}</span><span class="text-slate-100 font-medium">{{ $job->location }}</span></div>
                        <div><span class="text-slate-400 block">{{ __('Experience') }}</span><span class="text-slate-100 font-medium">{{ $job->experience_years }}</span></div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.jobs.nominate.store', $job) }}">
                    @csrf
                    
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-white">{{ __('Select Candidates to Nominate') }}</h3>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-lg transition flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            {{ __('Send Nominations to Company') }}
                        </button>
                    </div>

                    @if($errors->any())
                        <div class="bg-rose-500/20 text-rose-400 p-4 rounded-xl mb-4 border border-rose-500/30">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full ltr:text-left rtl:text-right border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700/50 text-slate-400 bg-slate-800/30">
                                    <th class="p-4 font-semibold w-12 text-center">
                                        <input type="checkbox" id="selectAll" class="rounded border-slate-600 bg-slate-900 text-indigo-500 focus:ring-indigo-500">
                                    </th>
                                    <th class="p-4 font-semibold">{{ __('Candidate Name') }}</th>
                                    <th class="p-4 font-semibold">{{ __('Headline / Target Job') }}</th>
                                    <th class="p-4 font-semibold">{{ __('Match Score') }}</th>
                                    <th class="p-4 font-semibold">{{ __('Experience') }}</th>
                                    <th class="p-4 font-semibold">{{ __('CV') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800">
                                @forelse($seekers as $seeker)
                                <tr class="hover:bg-slate-800/30 transition duration-150">
                                    <td class="p-4 text-center">
                                        <input type="checkbox" name="user_ids[]" value="{{ $seeker->id }}" class="candidate-checkbox rounded border-slate-600 bg-slate-900 text-indigo-500 focus:ring-indigo-500">
                                    </td>
                                    <td class="p-4 font-medium text-white">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-slate-700 text-white flex items-center justify-center mr-3 font-bold text-xs border border-slate-600">
                                                {{ mb_substr($seeker->first_name, 0, 1, 'UTF-8') }}
                                            </div>
                                            <div>
                                                <div>{{ $seeker->name }}</div>
                                                <div class="text-xs text-slate-400">{{ $seeker->location }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-slate-300">
                                        <div class="font-medium text-sky-400">{{ $seeker->headline ?: __('Not Specified') }}</div>
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach($seeker->userSkills->take(3) as $userSkill)
                                                <span class="text-[10px] bg-slate-800 px-2 py-0.5 rounded-full text-slate-300 border border-slate-700">{{ $userSkill->skill->name }}</span>
                                            @endforeach
                                            @if($seeker->userSkills->count() > 3)
                                                <span class="text-[10px] text-slate-500">+{{ $seeker->userSkills->count() - 3 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 bg-slate-800 rounded-full h-2 overflow-hidden border border-slate-700">
                                                <div class="h-full bg-gradient-to-r from-teal-500 to-emerald-400 rounded-full" style="width: {{ $seeker->match_score ?? 60 }}%"></div>
                                            </div>
                                            <span class="text-xs font-bold text-emerald-400 font-mono">{{ $seeker->match_score ?? 60 }}%</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-slate-300">{{ $seeker->years_of_experience }}</td>
                                    <td class="p-4">
                                        @if($seeker->resumes->count() > 0)
                                            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">{{ __('Available') }}</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-slate-800 text-slate-500">{{ __('No CV') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-slate-400">
                                        {{ __('No candidates available to nominate. They might have already been nominated for this job.') }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.candidate-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
</x-app-layout>
