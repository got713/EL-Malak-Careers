<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Edit Job Requirement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card rounded-2xl p-8 shadow-2xl">
                <form method="POST" action="{{ route('company.jobs.update', $job) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Job Title -->
                        <div class="md:col-span-2">
                            <x-input-label for="title" :value="__('Job Title')" class="text-slate-300" />
                            <x-text-input id="title" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="title" :value="old('title', $job->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Job Description -->
                        <div class="md:col-span-2">
                            <x-input-label for="description" :value="__('Job Description')" class="text-slate-300" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description', $job->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Job Requirements -->
                        <div class="md:col-span-2">
                            <x-input-label for="requirements" :value="__('Job Requirements (Skills, Education, etc)')" class="text-slate-300" />
                            <textarea id="requirements" name="requirements" rows="4" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('requirements', $job->requirements) }}</textarea>
                            <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                        </div>

                        <!-- Type -->
                        <div>
                            <x-input-label for="type" :value="__('Employment Type')" class="text-slate-300" />
                            <select id="type" name="type" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled>{{ __('Select Type') }}</option>
                                <option value="full-time" {{ old('type', $job->type) == 'full-time' ? 'selected' : '' }}>{{ __('Full-Time') }}</option>
                                <option value="part-time" {{ old('type', $job->type) == 'part-time' ? 'selected' : '' }}>{{ __('Part-Time') }}</option>
                                <option value="remote" {{ old('type', $job->type) == 'remote' ? 'selected' : '' }}>{{ __('Remote') }}</option>
                                <option value="contract" {{ old('type', $job->type) == 'contract' ? 'selected' : '' }}>{{ __('Contract') }}</option>
                                <option value="internship" {{ old('type', $job->type) == 'internship' ? 'selected' : '' }}>{{ __('Internship') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div>
                            <x-input-label for="location" :value="__('Location')" class="text-slate-300" />
                            <x-text-input id="location" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="location" :value="old('location', $job->location)" placeholder="e.g. Cairo, Egypt or Remote" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Number of Vacancies -->
                        <div>
                            <x-input-label for="vacancies" :value="__('Number of Vacancies')" class="text-slate-300" />
                            <x-text-input id="vacancies" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="number" min="1" name="vacancies" :value="old('vacancies', $job->vacancies)" required />
                            <x-input-error :messages="$errors->get('vacancies')" class="mt-2" />
                        </div>

                        <!-- Years of Experience -->
                        <div>
                            <x-input-label for="experience_years" :value="__('Years of Experience')" class="text-slate-300" />
                            <x-text-input id="experience_years" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="experience_years" :value="old('experience_years', $job->experience_years)" placeholder="e.g. 1-3 Years" required />
                            <x-input-error :messages="$errors->get('experience_years')" class="mt-2" />
                        </div>

                        <!-- Salary Range (Optional) -->
                        <div class="md:col-span-2">
                            <x-input-label for="salary_range" :value="__('Salary Range (Optional)')" class="text-slate-300" />
                            <x-text-input id="salary_range" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="salary_range" :value="old('salary_range', $job->salary_range)" placeholder="e.g. 10,000" />
                            <x-input-error :messages="$errors->get('salary_range')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-500 text-white shadow-[0_0_15px_rgba(79,70,229,0.5)]">
                            {{ __('Update Job') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
