<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Registered Users') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.export') . '?' . http_build_query(request()->only(['search','religion','location','status'])) }}"
                   class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    {{ __('Export Excel') }}
                </a>
                <a href="{{ route('admin.users.exportCvs') . '?' . http_build_query(request()->only(['search','religion','location','status'])) }}"
                   class="bg-purple-600 hover:bg-purple-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg flex items-center gap-2"
                   title="{{ __('Download all CV documents in a single ZIP file') }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                    </svg>
                    {{ __('Download All CVs (ZIP)') }}
                </a>
                <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Create New User') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Stats Dashboard Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Candidates -->
                <div class="glass-card rounded-2xl p-6 relative overflow-hidden border border-slate-800/80 hover:border-indigo-500/50 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">{{ __('Total Candidates') }}</span>
                            <span class="text-3xl font-extrabold text-white group-hover:scale-105 transition-transform inline-block">{{ number_format($totalUsersCount ?? 0) }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Review -->
                <div class="glass-card rounded-2xl p-6 relative overflow-hidden border border-slate-800/80 hover:border-amber-500/50 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">{{ __('Pending Review') }}</span>
                            <span class="text-3xl font-extrabold text-amber-400 group-hover:scale-105 transition-transform inline-block">{{ number_format($pendingUsersCount ?? 0) }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Reviewed Candidates -->
                <div class="glass-card rounded-2xl p-6 relative overflow-hidden border border-slate-800/80 hover:border-emerald-500/50 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">{{ __('Reviewed Candidates') }}</span>
                            <span class="text-3xl font-extrabold text-emerald-400 group-hover:scale-105 transition-transform inline-block">{{ number_format($reviewedUsersCount ?? 0) }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Uploaded Resumes -->
                <div class="glass-card rounded-2xl p-6 relative overflow-hidden border border-slate-800/80 hover:border-sky-500/50 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">{{ __('Uploaded CVs') }}</span>
                            <span class="text-3xl font-extrabold text-sky-400 group-hover:scale-105 transition-transform inline-block">{{ number_format($cvCount ?? 0) }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-sky-500/10 border border-sky-500/20 text-sky-400 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
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

            <form method="GET" action="{{ route('admin.users.index') }}" class="glass-card rounded-2xl shadow-xl p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                    <!-- Search Keyword -->
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-sm font-medium text-slate-300 mb-1">{{ __('Search (Name, Email, Phone)') }}</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" class="w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" placeholder="{{ __('Type to search...') }}">
                    </div>

                    <!-- Religion -->
                    <div>
                        <label for="religion" class="block text-sm font-medium text-slate-300 mb-1">{{ __('Religion') }}</label>
                        <select name="religion" id="religion" class="w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm">
                            <option value="">{{ __('All Religions') }}</option>
                            <option value="christian" {{ request('religion') == 'christian' ? 'selected' : '' }}>{{ __('Christian') }}</option>
                            <option value="muslim" {{ request('religion') == 'muslim' ? 'selected' : '' }}>{{ __('Muslim') }}</option>
                            <option value="other" {{ request('religion') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300 mb-1">{{ __('Status') }}</label>
                        <select name="status" id="status" class="w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm">
                            <option value="">{{ __('All Statuses') }}</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>{{ __('Reviewed') }}</option>
                        </select>
                    </div>

                    <!-- Filter Button -->
                    <div>
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg font-semibold transition shadow-lg h-[42px] flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            {{ __('Filter') }}
                        </button>
                    </div>

                    <!-- Export Excel Button -->
                    <div>
                        <a id="export-excel-btn"
                           href="#"
                           onclick="exportWithFilters(event)"
                           class="w-full bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-lg font-semibold transition shadow-lg h-[42px] flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            {{ __('Export Excel') }}
                        </a>
                    </div>
                </div>
            </form>

            <script>
            function exportWithFilters(e) {
                e.preventDefault();
                const form = document.querySelector('form[method="GET"]');
                const data = new FormData(form);
                const params = new URLSearchParams();
                data.forEach((value, key) => { if (value) params.append(key, value); });
                const exportUrl = '{{ route("admin.users.export") }}' + (params.toString() ? '?' + params.toString() : '');
                window.location.href = exportUrl;
            }
            </script>

            <div class="glass-card rounded-2xl overflow-hidden shadow-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="w-full ltr:text-left rtl:text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-700/50 text-slate-400">
                                <th class="p-4 font-semibold">{{ __('Name') }}</th>
                                <th class="p-4 font-semibold">{{ __('Phone') }}</th>
                                <th class="p-4 font-semibold">{{ __('Date') }}</th>
                                <th class="p-4 font-semibold text-center">{{ __('Nominations') }}</th>
                                <th class="p-4 font-semibold">{{ __('Status') }}</th>
                                <th class="p-4 font-semibold ltr:text-right rtl:text-left">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse($users as $user)
                            <tr class="hover:bg-slate-800/30 transition duration-150">
                                <td class="p-4">
                                    <span class="block font-medium text-white">{{ $user->name }}</span>
                                    @if($user->headline)
                                        <span class="block text-xs text-slate-400 mt-1">{{ $user->headline }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-slate-300">
                                    @if($user->phone)
                                        <div class="flex items-center gap-2">
                                            <a href="tel:{{ $user->phone }}" class="text-sky-400 hover:text-sky-300 hover:underline font-mono text-sm" dir="ltr">{{ $user->phone }}</a>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" class="text-emerald-400 hover:text-emerald-300 transition" title="{{ __('Chat on WhatsApp') }}">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-slate-500 text-xs font-medium">{{ __('Not Specified') }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-slate-400 font-mono text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="p-4 text-center">
                                    @if($user->applications_count > 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 font-mono">
                                            {{ $user->applications_count }}
                                        </span>
                                    @else
                                        <span class="text-slate-500 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($user->application_status === 'pending')
                                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">{{ __('Pending') }}</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">{{ __('Reviewed') }}</span>
                                        @if($user->reviewedBy)
                                            <span class="block mt-1 text-[10px] text-slate-500">{{ __('by') }} {{ $user->reviewedBy->name }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2 ltr:justify-end rtl:justify-start" x-data>
                                        <!-- Quick View Modal Trigger -->
                                        <button type="button" 
                                                @click="$dispatch('open-quick-view', {{ json_encode([
                                                    'id' => $user->id,
                                                    'name' => $user->name,
                                                    'email' => $user->email,
                                                    'phone' => $user->phone,
                                                    'headline' => $user->headline,
                                                    'location' => $user->location,
                                                    'religion' => $user->religion,
                                                    'nationality' => $user->nationality,
                                                    'gender' => $user->gender,
                                                    'birth_date' => $user->birth_date ? $user->birth_date->format('Y-m-d') : null,
                                                    'education_status' => $user->education_status,
                                                    'education_degree' => $user->education_degree,
                                                    'years_of_experience' => $user->years_of_experience,
                                                    'worker_type' => $user->worker_type,
                                                    'employment_status' => $user->employment_status,
                                                    'current_company' => $user->current_company,
                                                    'last_salary' => $user->last_salary,
                                                    'confession_father' => $user->confession_father,
                                                    'applicant_church' => $user->applicant_church,
                                                    'linkedin_url' => $user->linkedin_url,
                                                    'experience_details' => $user->experience_details,
                                                    'application_status' => $user->application_status,
                                                    'created_at' => $user->created_at->format('Y-m-d H:i'),
                                                    'show_url' => route('admin.users.show', $user),
                                                    'mark_reviewed_url' => route('admin.users.markReviewed', $user),
                                                    'cv_url' => $user->resumes->first() ? route('resumes.download', $user->resumes->first()) : null,
                                                ]) }})"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-purple-500/10 text-purple-400 hover:bg-purple-500 hover:text-white border border-purple-500/20 transition-all shadow-sm group" title="{{ __('Quick View') }}">
                                            <svg class="w-4 h-4 text-purple-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            <span>{{ __('Quick View') }}</span>
                                        </button>

                                        <!-- View Details -->
                                        <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-sky-500/10 text-sky-400 hover:bg-sky-500 hover:text-white border border-sky-500/20 transition-all shadow-sm group" title="{{ __('View Details') }}">
                                            <svg class="w-4 h-4 text-sky-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            <span>{{ __('Full Profile') }}</span>
                                        </a>
                                        
                                        <!-- Mark Reviewed -->
                                        @if($user->application_status === 'pending')
                                        <form action="{{ route('admin.users.markReviewed', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500 hover:text-white border border-emerald-500/20 transition-all shadow-sm group" title="{{ __('Mark as Reviewed') }}">
                                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                                <span>{{ __('Review') }}</span>
                                            </button>
                                        </form>
                                        @endif

                                        <!-- Delete -->
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this user?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white border border-rose-500/20 transition-all shadow-sm group" title="{{ __('Delete User') }}">
                                                <svg class="w-4 h-4 text-rose-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                <span>{{ __('Delete') }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">
                                    {{ __('No registered users found.') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal Component -->
    <div x-data="{ open: false, user: {} }"
         @open-quick-view.window="open = true; user = $event.detail"
         x-show="open"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            
            <div x-show="open" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="open = false" 
                 class="fixed inset-0 transition-opacity bg-slate-950/80 backdrop-blur-sm" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="open" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block w-full max-w-3xl p-6 my-8 overflow-hidden ltr:text-left rtl:text-right align-middle transition-all transform bg-slate-900 border border-slate-700/60 shadow-2xl rounded-2xl">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                            <span x-text="user.name ? user.name.charAt(0) : ''"></span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white" x-text="user.name"></h3>
                            <p class="text-xs text-slate-400" x-text="user.headline || '{{ __('No headline specified') }}'"></p>
                        </div>
                    </div>
                    <button @click="open = false" class="text-slate-400 hover:text-white p-2 rounded-lg hover:bg-slate-800 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="space-y-6 max-h-[65vh] overflow-y-auto custom-scrollbar p-1">
                    
                    <!-- Contact Info Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-800/40 p-4 rounded-xl border border-slate-800">
                        <div>
                            <span class="text-xs font-semibold text-slate-400 block">{{ __('Email') }}</span>
                            <span class="text-sm font-medium text-slate-200 font-mono" x-text="user.email"></span>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-slate-400 block">{{ __('Phone') }}</span>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-slate-200 font-mono" x-text="user.phone || '{{ __('Not Specified') }}'"></span>
                                <template x-if="user.phone">
                                    <a :href="'https://wa.me/' + user.phone.replace(/[^0-9]/g, '')" target="_blank" class="text-emerald-400 hover:text-emerald-300">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Personal & Professional Details Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="bg-slate-800/20 p-3 rounded-xl border border-slate-800">
                            <span class="text-xs font-semibold text-slate-400 block">{{ __('Location') }}</span>
                            <span class="text-sm font-medium text-slate-200" x-text="user.location || '{{ __('Not Specified') }}'"></span>
                        </div>
                        <div class="bg-slate-800/20 p-3 rounded-xl border border-slate-800">
                            <span class="text-xs font-semibold text-slate-400 block">{{ __('Religion') }}</span>
                            <span class="text-sm font-medium text-slate-200" x-text="user.religion || '{{ __('Not Specified') }}'"></span>
                        </div>
                        <div class="bg-slate-800/20 p-3 rounded-xl border border-slate-800">
                            <span class="text-xs font-semibold text-slate-400 block">{{ __('Years of Experience') }}</span>
                            <span class="text-sm font-medium text-slate-200" x-text="user.years_of_experience || '{{ __('Not Specified') }}'"></span>
                        </div>
                        <div class="bg-slate-800/20 p-3 rounded-xl border border-slate-800">
                            <span class="text-xs font-semibold text-slate-400 block">{{ __('Education Degree') }}</span>
                            <span class="text-sm font-medium text-slate-200" x-text="user.education_degree || '{{ __('Not Specified') }}'"></span>
                        </div>
                        <div class="bg-slate-800/20 p-3 rounded-xl border border-slate-800">
                            <span class="text-xs font-semibold text-slate-400 block">{{ __('Father of Confession') }}</span>
                            <span class="text-sm font-medium text-slate-200" x-text="user.confession_father || '{{ __('Not Specified') }}'"></span>
                        </div>
                        <div class="bg-slate-800/20 p-3 rounded-xl border border-slate-800">
                            <span class="text-xs font-semibold text-slate-400 block">{{ __('Applicant Church') }}</span>
                            <span class="text-sm font-medium text-slate-200" x-text="user.applicant_church || '{{ __('Not Specified') }}'"></span>
                        </div>
                    </div>

                    <!-- Experience Details -->
                    <template x-if="user.experience_details">
                        <div class="bg-slate-800/30 p-4 rounded-xl border border-slate-800">
                            <span class="text-xs font-semibold text-slate-400 block mb-1">{{ __('Experience Details') }}</span>
                            <p class="text-sm text-slate-300 leading-relaxed whitespace-pre-line" x-text="user.experience_details"></p>
                        </div>
                    </template>

                    <!-- CV Download Button -->
                    <template x-if="user.cv_url">
                        <div class="bg-indigo-950/40 p-4 rounded-xl border border-indigo-800/40 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <div>
                                    <span class="text-sm font-bold text-white block">{{ __('Uploaded CV Document') }}</span>
                                    <span class="text-xs text-indigo-300">{{ __('Ready for download') }}</span>
                                </div>
                            </div>
                            <a :href="user.cv_url" target="_blank" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-xs font-bold transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                {{ __('Download CV') }}
                            </a>
                        </div>
                    </template>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-between pt-4 mt-6 border-t border-slate-800">
                    <a :href="user.show_url" class="text-sky-400 hover:text-sky-300 text-xs font-bold flex items-center gap-1">
                        <span>{{ __('Open Full Profile Page') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    
                    <button @click="open = false" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-5 py-2 rounded-lg text-xs font-bold transition">
                        {{ __('Close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
