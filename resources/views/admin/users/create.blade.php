<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Create New User') }}
            </h2>
            <a href="{{ route('admin.users.index') }}" class="text-slate-400 hover:text-white transition">
                {!! __('&larr; Back to Users') !!}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card rounded-2xl p-8 shadow-2xl">
                <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" class="text-slate-300" />
                            <x-text-input id="first_name" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="first_name" :value="old('first_name')" required autofocus />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" class="text-slate-300" />
                            <x-text-input id="last_name" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="last_name" :value="old('last_name')" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email Address')" class="text-slate-300" />
                            <x-text-input id="email" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-slate-300" />
                            <x-text-input id="password" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <x-input-label for="phone" :value="__('Phone Number')" class="text-slate-300" />
                            <x-text-input id="phone" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="phone" :value="old('phone')" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div>
                            <x-input-label for="location" :value="__('Location')" class="text-slate-300" />
                            <select id="location" name="location" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled selected>{{ __('Select Location') }}</option>
                                <option value="Cairo" {{ old('location') == 'Cairo' ? 'selected' : '' }}>{{ __('Cairo') }}</option>
                                <option value="Alexandria" {{ old('location') == 'Alexandria' ? 'selected' : '' }}>{{ __('Alexandria') }}</option>
                                <option value="Giza" {{ old('location') == 'Giza' ? 'selected' : '' }}>{{ __('Giza') }}</option>
                                <option value="Qalyubia" {{ old('location') == 'Qalyubia' ? 'selected' : '' }}>{{ __('Qalyubia') }}</option>
                                <option value="Port Said" {{ old('location') == 'Port Said' ? 'selected' : '' }}>{{ __('Port Said') }}</option>
                                <option value="Suez" {{ old('location') == 'Suez' ? 'selected' : '' }}>{{ __('Suez') }}</option>
                                <option value="Gharbia" {{ old('location') == 'Gharbia' ? 'selected' : '' }}>{{ __('Gharbia') }}</option>
                                <option value="Dakahlia" {{ old('location') == 'Dakahlia' ? 'selected' : '' }}>{{ __('Dakahlia') }}</option>
                                <option value="Ismailia" {{ old('location') == 'Ismailia' ? 'selected' : '' }}>{{ __('Ismailia') }}</option>
                                <option value="Asyut" {{ old('location') == 'Asyut' ? 'selected' : '' }}>{{ __('Asyut') }}</option>
                                <option value="Faiyum" {{ old('location') == 'Faiyum' ? 'selected' : '' }}>{{ __('Faiyum') }}</option>
                                <option value="Minya" {{ old('location') == 'Minya' ? 'selected' : '' }}>{{ __('Minya') }}</option>
                                <option value="Sharqia" {{ old('location') == 'Sharqia' ? 'selected' : '' }}>{{ __('Sharqia') }}</option>
                                <option value="Aswan" {{ old('location') == 'Aswan' ? 'selected' : '' }}>{{ __('Aswan') }}</option>
                                <option value="Damietta" {{ old('location') == 'Damietta' ? 'selected' : '' }}>{{ __('Damietta') }}</option>
                                <option value="Beheira" {{ old('location') == 'Beheira' ? 'selected' : '' }}>{{ __('Beheira') }}</option>
                                <option value="Beni Suef" {{ old('location') == 'Beni Suef' ? 'selected' : '' }}>{{ __('Beni Suef') }}</option>
                                <option value="Kafr El Sheikh" {{ old('location') == 'Kafr El Sheikh' ? 'selected' : '' }}>{{ __('Kafr El Sheikh') }}</option>
                                <option value="Matrouh" {{ old('location') == 'Matrouh' ? 'selected' : '' }}>{{ __('Matrouh') }}</option>
                                <option value="Luxor" {{ old('location') == 'Luxor' ? 'selected' : '' }}>{{ __('Luxor') }}</option>
                                <option value="Qena" {{ old('location') == 'Qena' ? 'selected' : '' }}>{{ __('Qena') }}</option>
                                <option value="North Sinai" {{ old('location') == 'North Sinai' ? 'selected' : '' }}>{{ __('North Sinai') }}</option>
                                <option value="Sohag" {{ old('location') == 'Sohag' ? 'selected' : '' }}>{{ __('Sohag') }}</option>
                                <option value="New Valley" {{ old('location') == 'New Valley' ? 'selected' : '' }}>{{ __('New Valley') }}</option>
                                <option value="Red Sea" {{ old('location') == 'Red Sea' ? 'selected' : '' }}>{{ __('Red Sea') }}</option>
                                <option value="South Sinai" {{ old('location') == 'South Sinai' ? 'selected' : '' }}>{{ __('South Sinai') }}</option>
                                <option value="Monufia" {{ old('location') == 'Monufia' ? 'selected' : '' }}>{{ __('Monufia') }}</option>
                                <option value="Other" {{ old('location') == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Religion -->
                        <div>
                            <x-input-label for="religion" :value="__('Religion')" class="text-slate-300" />
                            <select id="religion" name="religion" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled selected>{{ __('Select Religion') }}</option>
                                <option value="Muslim" {{ old('religion') == 'Muslim' ? 'selected' : '' }}>{{ __('Muslim') }}</option>
                                <option value="Christian" {{ old('religion') == 'Christian' ? 'selected' : '' }}>{{ __('Christian') }}</option>
                                <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('religion')" class="mt-2" />
                        </div>

                        <!-- Nationality -->
                        <div>
                            <x-input-label for="nationality" :value="__('Nationality')" class="text-slate-300" />
                            <x-text-input id="nationality" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="nationality" :value="old('nationality', 'Egyptian')" required />
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <x-input-label for="birth_date" :value="__('Date of Birth (18+)')" class="text-slate-300" />
                            <x-text-input id="birth_date" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="date" name="birth_date" :value="old('birth_date')" required />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>

                        <!-- Education Status -->
                        <div>
                            <x-input-label for="education_status" :value="__('Education Status')" class="text-slate-300" />
                            <select id="education_status" name="education_status" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled selected>{{ __('Select Status') }}</option>
                                <option value="studying" {{ old('education_status') == 'studying' ? 'selected' : '' }}>{{ __('Currently Studying') }}</option>
                                <option value="graduated" {{ old('education_status') == 'graduated' ? 'selected' : '' }}>{{ __('Graduated') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('education_status')" class="mt-2" />
                        </div>

                        <!-- Education Degree -->
                        <div class="md:col-span-2">
                            <x-input-label for="education_degree" :value="__('Education Degree')" class="text-slate-300" />
                            <x-text-input id="education_degree" class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-indigo-500 focus:ring-indigo-500" type="text" name="education_degree" :value="old('education_degree')" required />
                            <x-input-error :messages="$errors->get('education_degree')" class="mt-2" />
                        </div>

                        <!-- CV Upload -->
                        <div class="md:col-span-2 p-4 border border-dashed border-slate-600 rounded-lg bg-slate-800/30">
                            <x-input-label for="cv" :value="__('Upload CV (PDF, DOC, DOCX)')" class="text-lg font-semibold text-white" />
                            <input id="cv" type="file" name="cv" accept=".pdf,.doc,.docx" class="mt-2 block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-500/20 file:text-indigo-400 hover:file:bg-indigo-500/30" required />
                            <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-500 text-white shadow-[0_0_15px_rgba(79,70,229,0.5)]">
                            {{ __('Create User') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
