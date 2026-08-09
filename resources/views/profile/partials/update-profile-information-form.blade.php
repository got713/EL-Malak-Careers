<section>
    <header>
        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('First Name') }}</label>
                <input id="first_name" name="first_name" type="text" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('first_name', $user->first_name) }}" required autofocus autocomplete="given-name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Last Name') }}</label>
                <input id="last_name" name="last_name" type="text" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('last_name', $user->last_name) }}" required autocomplete="family-name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>

            <!-- Email -->
            <div class="md:col-span-2">
                <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="input-premium w-full !py-2.5 !text-sm ltr:text-left rtl:text-right" value="{{ old('email', $user->email) }}" required autocomplete="username" dir="ltr" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 bg-amber-50 dark:bg-amber-900/20 p-4 rounded-xl border border-amber-200 dark:border-amber-800/30">
                        <p class="text-sm text-amber-800 dark:text-amber-200 flex items-center justify-between">
                            <span>{{ __('Your email address is unverified.') }}</span>
                            <button form="send-verification" class="px-3 py-1 bg-amber-100 hover:bg-amber-200 dark:bg-amber-800 dark:hover:bg-amber-700 text-amber-900 dark:text-amber-100 rounded-lg text-xs font-bold transition-colors">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-3 font-bold text-sm text-emerald-600 dark:text-emerald-400">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Phone Number') }}</label>
                <input id="phone" name="phone" type="text" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('phone', $user->phone) }}" dir="ltr" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            @if(!auth()->user()->hasRole('company'))
            <!-- Target Headline -->
            <div>
                <label for="headline" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Target Headline') }}</label>
                <input id="headline" name="headline" type="text" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('headline', $user->headline) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('headline')" />
            </div>

            <!-- Years of Experience -->
            <div>
                <label for="years_of_experience" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Years of Experience') }}</label>
                <select id="years_of_experience" name="years_of_experience" class="input-premium w-full !py-2.5 !text-sm">
                    <option value="" disabled>{{ __('Select Experience') }}</option>
                    <option value="0" class="bg-white dark:bg-slate-800" {{ old('years_of_experience', $user->years_of_experience) == '0' ? 'selected' : '' }}>{{ __('Fresh Graduate / No Experience') }}</option>
                    <option value="1-3" class="bg-white dark:bg-slate-800" {{ old('years_of_experience', $user->years_of_experience) == '1-3' ? 'selected' : '' }}>{{ __('1 to 3 Years') }}</option>
                    <option value="3-5" class="bg-white dark:bg-slate-800" {{ old('years_of_experience', $user->years_of_experience) == '3-5' ? 'selected' : '' }}>{{ __('3 to 5 Years') }}</option>
                    <option value="5+" class="bg-white dark:bg-slate-800" {{ old('years_of_experience', $user->years_of_experience) == '5+' ? 'selected' : '' }}>{{ __('More than 5 Years') }}</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('years_of_experience')" />
            </div>

            <!-- LinkedIn URL -->
            <div>
                <label for="linkedin_url" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('LinkedIn Profile URL (Optional)') }}</label>
                <input id="linkedin_url" name="linkedin_url" type="url" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('linkedin_url', $user->linkedin_url) }}" dir="ltr" />
                <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
            </div>

            <!-- Father of Confession & Church -->
            <div>
                <label for="confession_father" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Father of Confession and his Church') }}</label>
                <input id="confession_father" name="confession_father" type="text" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('confession_father', $user->confession_father) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('confession_father')" />
            </div>

            <!-- Applicant's Church -->
            <div>
                <label for="applicant_church" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __("Applicant's Church") }}</label>
                <input id="applicant_church" name="applicant_church" type="text" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('applicant_church', $user->applicant_church) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('applicant_church')" />
            </div>

            <!-- Current Company Name -->
            <div>
                <label for="current_company" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Current Company Name (If any)') }}</label>
                <input id="current_company" name="current_company" type="text" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('current_company', $user->current_company) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('current_company')" />
            </div>

            <!-- Employment Status -->
            <div>
                <label for="employment_status" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Employment Status') }}</label>
                <select id="employment_status" name="employment_status" class="input-premium w-full !py-2.5 !text-sm">
                    <option value="" disabled selected>{{ __('Select Status') }}</option>
                    <option value="employed" class="bg-white dark:bg-slate-800" {{ old('employment_status', $user->employment_status) == 'employed' ? 'selected' : '' }}>{{ __('Employed') }}</option>
                    <option value="unemployed" class="bg-white dark:bg-slate-800" {{ old('employment_status', $user->employment_status) == 'unemployed' ? 'selected' : '' }}>{{ __('Unemployed') }}</option>
                    <option value="other" class="bg-white dark:bg-slate-800" {{ old('employment_status', $user->employment_status) == 'other' ? 'selected' : '' }}>{{ __('Other (Specify)') }}</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('employment_status')" />
            </div>

            <!-- Application Date -->
            <div>
                <label for="application_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Application Date') }}</label>
                <input id="application_date" name="application_date" type="date" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('application_date', $user->application_date ? $user->application_date->format('Y-m-d') : '') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('application_date')" />
            </div>

            <!-- Last Salary -->
            <div>
                <label for="last_salary" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Last Salary') }}</label>
                <input id="last_salary" name="last_salary" type="text" class="input-premium w-full !py-2.5 !text-sm" value="{{ old('last_salary', $user->last_salary) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('last_salary')" />
            </div>

            <!-- Languages -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 ltr:text-left rtl:text-right">{{ __('Languages') }}</label>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-slate-50 dark:bg-slate-800/50 p-3 rounded-xl border border-slate-200 dark:border-slate-700">
                    <label class="flex items-center space-x-2 rtl:space-x-reverse cursor-pointer">
                        <input type="checkbox" name="languages[]" value="Arabic" class="rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-teal-500 focus:ring-teal-500" {{ (is_array($user->languages) && in_array('Arabic', $user->languages)) || (is_array(old('languages')) && in_array('Arabic', old('languages'))) ? 'checked' : '' }}>
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('Arabic') }}</span>
                    </label>
                    <label class="flex items-center space-x-2 rtl:space-x-reverse cursor-pointer">
                        <input type="checkbox" name="languages[]" value="English" class="rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-teal-500 focus:ring-teal-500" {{ (is_array($user->languages) && in_array('English', $user->languages)) || (is_array(old('languages')) && in_array('English', old('languages'))) ? 'checked' : '' }}>
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('English') }}</span>
                    </label>
                    <label class="flex items-center space-x-2 rtl:space-x-reverse cursor-pointer">
                        <input type="checkbox" name="languages[]" value="French" class="rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-teal-500 focus:ring-teal-500" {{ (is_array($user->languages) && in_array('French', $user->languages)) || (is_array(old('languages')) && in_array('French', old('languages'))) ? 'checked' : '' }}>
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('French') }}</span>
                    </label>
                    <label class="flex items-center space-x-2 rtl:space-x-reverse cursor-pointer">
                        <input type="checkbox" name="languages[]" value="Other" class="rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-teal-500 focus:ring-teal-500" {{ (is_array($user->languages) && in_array('Other', $user->languages)) || (is_array(old('languages')) && in_array('Other', old('languages'))) ? 'checked' : '' }}>
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('Other (Specify)') }}</span>
                    </label>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('languages')" />
            </div>

            <!-- Microsoft Office - Computer Skills -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 ltr:text-left rtl:text-right">{{ __('Microsoft Office - Computer Skills') }}</label>
                <div class="flex items-center justify-between gap-2 bg-slate-50 dark:bg-slate-800/50 p-3 rounded-xl border border-slate-200 dark:border-slate-700">
                    @foreach([1, 2, 3, 4, 5] as $score)
                        <label class="flex-grow cursor-pointer text-center">
                            <input type="radio" name="microsoft_office_skills" value="{{ $score }}" class="sr-only peer" {{ old('microsoft_office_skills', $user->microsoft_office_skills) == $score ? 'checked' : '' }}>
                            <div class="py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 font-bold peer-checked:border-teal-500 peer-checked:bg-teal-500/10 peer-checked:text-teal-600 dark:peer-checked:text-teal-400 transition-all hover:border-teal-500/50">
                                {{ $score }}
                            </div>
                        </label>
                    @endforeach
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('microsoft_office_skills')" />
            </div>

            <!-- Experience Details -->
            <div class="md:col-span-2">
                <label for="experience_details" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 ltr:text-left rtl:text-right">{{ __('Experience Details') }}</label>
                <textarea id="experience_details" name="experience_details" rows="3" class="input-premium w-full !py-2.5 !text-sm" placeholder="{{ __('Please describe your previous experience and responsibilities in detail...') }}">{{ old('experience_details', $user->experience_details) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('experience_details')" />
            </div>
            @endif

        </div>

        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-slate-100 dark:border-slate-700">
            <button type="submit" class="btn-primary !px-8 !py-2.5 !rounded-lg text-sm">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 px-3 py-1.5 rounded-lg border border-emerald-200 dark:border-emerald-800/30">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
