<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Complete Your Profile') }} — {{ config('app.name', 'Malak Careers') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: #081B29; 
            color: #FFFFFF; 
        }
        html[dir="rtl"] body, 
        html[dir="rtl"] input, 
        html[dir="rtl"] button, 
        html[dir="rtl"] select, 
        html[dir="rtl"] textarea { 
            font-family: 'Cairo', sans-serif !important; 
        }

        /* Custom Scrollbars */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #081B29 !important; }
        ::-webkit-scrollbar-thumb { background: #23364A !important; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #14B8A6 !important; }

        /* ── Layout ── */
        .cp-wrap { 
            display: grid; 
            grid-template-columns: 40% 60%; 
            min-height: 100vh; 
        }
        @media(max-width: 1024px) { 
            .cp-wrap { grid-template-columns: 1fr; } 
            .cp-side { display: none; } 
        }

        /* ── Side panel ── */
        .cp-side {
            background: linear-gradient(135deg, #081B29 0%, #112235 100%);
            border-inline-end: 1px solid #23364A;
            position: relative; 
            overflow: hidden;
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            padding: 3rem 2.5rem;
        }
        
        /* Ambient Orbs */
        .orb { 
            position: absolute; 
            border-radius: 9999px; 
            filter: blur(80px); 
            animation: pulse-orb 8s ease-in-out infinite alternate; 
            opacity: 0.15;
        }
        @keyframes pulse-orb { 
            0% { transform: scale(1) translate(0, 0); opacity: 0.12; } 
            100% { transform: scale(1.2) translate(10px, -20px); opacity: 0.22; } 
        }

        /* ── Step timeline ── */
        .timeline { 
            display: flex; 
            flex-direction: column; 
            gap: 0; 
            width: 100%; 
            position: relative; 
            z-index: 1; 
        }
        .tl-item { 
            display: flex; 
            align-items: flex-start; 
            gap: 1.5rem; 
        }
        .tl-connector { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
        }
        .tl-dot {
            width: 3.25rem; 
            height: 3.25rem; 
            border-radius: 9999px; 
            flex-shrink: 0;
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: 800; 
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .tl-dot.active { 
            background: linear-gradient(135deg, #14B8A6, #0F766E); 
            color: #fff; 
            box-shadow: 0 0 0 6px rgba(20, 184, 166, 0.25), 0 6px 24px rgba(20, 184, 166, 0.45); 
        }
        .tl-dot.done { 
            background: #10B981; 
            color: #fff; 
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3); 
        }
        .tl-dot.pending { 
            background: #081B29; 
            color: #475569; 
            border: 2px solid #23364A; 
        }
        .tl-line { 
            width: 3px; 
            height: 4.5rem; 
            margin: 0.3rem 0; 
            border-radius: 9999px; 
            transition: background 0.4s; 
        }
        .tl-line.done { 
            background: linear-gradient(to bottom, #10B981, #14B8A6); 
        }
        .tl-line.pending { 
            background: #23364A; 
        }
        
        .tl-label { 
            padding-top: 0.5rem; 
            text-align: start;
        }
        .tl-label .title { 
            font-size: 1.15rem; 
            font-weight: 800; 
            transition: color 0.3s; 
        }
        .tl-label .title.active { color: #ffffff; }
        .tl-label .title.done { color: #10B981; }
        .tl-label .title.pending { color: #64748B; }
        
        .tl-label .sub { 
            font-size: 0.875rem; 
            color: #475569; 
            margin-top: 0.25rem; 
            transition: color 0.3s; 
        }
        .tl-label .sub.active { color: #CBD5E1; }
        .tl-label .sub.pending { color: #64748B; }

        /* ── Form side ── */
        .cp-form-side {
            background-color: #081B29; 
            display: flex; 
            flex-direction: column;
            justify-content: center; 
            padding: 3rem 4rem; 
            overflow-y: auto;
        }
        @media(max-width: 640px) { 
            .cp-form-side { padding: 1.5rem 1rem; } 
        }

        /* ── Glass Card Container ── */
        .glass-card { 
            background: #112235; 
            border: 1px solid #23364A; 
            border-radius: 20px; 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4); 
            padding: 2.5rem;
        }
        @media(max-width: 640px) {
            .glass-card { padding: 1.5rem 1.25rem; }
        }

        /* ── Inputs ── */
        .cp-label { 
            display: block; 
            font-size: 0.85rem; 
            font-weight: 600; 
            color: #94A3B8; 
            margin-bottom: 0.5rem; 
            text-align: start;
        }
        .cp-input {
            width: 100%; 
            padding: 0.75rem 1rem;
            background: #081B29; 
            border: 1px solid #23364A;
            border-radius: 12px; 
            color: #FFFFFF; 
            font-size: 0.875rem; 
            outline: none;
            font-family: inherit;
            transition: border-color 0.25s, box-shadow 0.25s;
            text-align: start;
        }
        .cp-input::placeholder { color: #475569; }
        .cp-input:focus { 
            border-color: #14B8A6; 
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.2); 
            background: #081B29;
        }
        .cp-input option { 
            background: #112235; 
            color: #FFFFFF; 
        }
        .cp-input[type="date"]::-webkit-calendar-picker-indicator { 
            filter: invert(0.8); 
            cursor: pointer; 
        }

        /* ── Buttons ── */
        .btn-gradient { 
            background: linear-gradient(to right, #14B8A6, #0F766E); 
            transition: all 250ms ease; 
        }
        .btn-gradient:hover { 
            filter: brightness(1.1); 
            transform: translateY(-1px); 
            box-shadow: 0 10px 20px rgba(20, 184, 166, 0.3); 
        }
        .btn-gradient:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .btn-back {
            display: inline-flex; 
            align-items: center; 
            gap: 0.5rem;
            padding: 0.75rem 1.5rem; 
            border-radius: 12px; 
            font-weight: 600; 
            font-size: 0.875rem;
            background: #081B29; 
            border: 1px solid #23364A;
            color: #94A3B8; 
            cursor: pointer; 
            transition: all 0.25s; 
            font-family: inherit;
        }
        .btn-back:hover { 
            background: #112235; 
            color: #FFFFFF; 
            border-color: #475569;
        }

        /* ── Step panel ── */
        .step-panel { 
            display: none; 
            animation: slide-in 0.3s ease; 
        }
        .step-panel.active { 
            display: block; 
        }
        @keyframes slide-in { 
            from { opacity: 0; transform: translateY(10px); } 
            to { opacity: 1; transform: translateY(0); } 
        }

        /* ── Progress bar ── */
        .prog-bar { 
            height: 4px; 
            background: #23364A; 
            border-radius: 9999px; 
            margin-bottom: 2rem; 
            overflow: hidden; 
        }
        .prog-fill { 
            height: 100%; 
            border-radius: 9999px; 
            background: linear-gradient(90deg, #14B8A6, #0F766E); 
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1); 
        }

        /* ── Badge ── */
        .google-badge {
            display: inline-flex; 
            align-items: center; 
            gap: 0.5rem;
            padding: 0.4rem 1rem; 
            border-radius: 9999px;
            background: #081B29; 
            border: 1px solid #23364A;
            font-size: 0.75rem; 
            font-weight: 600; 
            color: #94A3B8; 
            margin-bottom: 1.5rem;
        }

        /* ── Card for step 3 ── */
        .info-card {
            padding: 1rem 1.25rem; 
            border-radius: 12px;
            background: rgba(20, 184, 166, 0.05); 
            border: 1px solid rgba(20, 184, 166, 0.15);
        }
    </style>
</head>
<body class="antialiased bg-slate-950 text-slate-100 overflow-x-hidden selection:bg-teal-500 selection:text-white">

<div class="cp-wrap" x-data="wizard()">

    {{-- ════════ LEFT/RIGHT: Side Panel ════════ --}}
    <div class="cp-side">
        <div class="orb w-96 h-96 bg-teal-500 top-[-8rem] left-[-8rem]"></div>
        <div class="orb w-80 h-80 bg-sky-500 bottom-[-5rem] right-[-5rem]" style="animation-delay: 3s"></div>

        <div class="relative z-10 w-full max-w-md px-4 text-start">
            {{-- Logo --}}
            <div class="mb-14">
                <a href="/">
                    <img src="{{ asset('images/logo.svg') }}" alt="Malak Careers" class="h-20 filter brightness-0 invert drop-shadow-2xl hover:scale-105 transition-transform duration-300">
                </a>
            </div>

            {{-- Welcome text --}}
            <div class="mb-12 text-start">
                <p class="text-teal-400 text-sm font-bold tracking-widest uppercase mb-3">{{ __('Logged in with Google') }}</p>
                <h1 class="text-white text-3xl font-black leading-snug mb-3">{{ __('Complete Your Profile') }}</h1>
                <p class="text-slate-300 text-base leading-relaxed">{{ __('Fill in your details so employers can find you') }}</p>
            </div>

            {{-- Step Timeline --}}
            <div class="timeline">
                {{-- Step 1 --}}
                <div class="tl-item">
                    <div class="tl-connector">
                        <div class="tl-dot" :class="step > 1 ? 'done' : (step === 1 ? 'active' : 'pending')">
                            <svg x-show="step > 1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            <span x-show="step <= 1">1</span>
                        </div>
                        <div class="tl-line" :class="step > 1 ? 'done' : 'pending'"></div>
                    </div>
                    <div class="tl-label">
                        <div class="title" :class="step > 1 ? 'done' : (step === 1 ? 'active' : 'pending')">{{ __('Personal Information') }}</div>
                        <div class="sub" :class="step === 1 ? 'active' : 'pending'">{{ __('Basic details about you') }}</div>
                    </div>
                </div>
                {{-- Step 2 --}}
                <div class="tl-item">
                    <div class="tl-connector">
                        <div class="tl-dot" :class="step > 2 ? 'done' : (step === 2 ? 'active' : 'pending')">
                            <svg x-show="step > 2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            <span x-show="step <= 2">2</span>
                        </div>
                        <div class="tl-line" :class="step > 2 ? 'done' : 'pending'"></div>
                    </div>
                    <div class="tl-label">
                        <div class="title" :class="step > 2 ? 'done' : (step === 2 ? 'active' : 'pending')">{{ __('Education') }}</div>
                        <div class="sub" :class="step === 2 ? 'active' : 'pending'">{{ __('Your academic background') }}</div>
                    </div>
                </div>
                {{-- Step 3 --}}
                <div class="tl-item">
                    <div class="tl-connector">
                        <div class="tl-dot" :class="step === 3 ? 'active' : 'pending'">3</div>
                    </div>
                    <div class="tl-label">
                        <div class="title" :class="step === 3 ? 'active' : 'pending'">{{ __('Career Profile') }}</div>
                        <div class="sub" :class="step === 3 ? 'active' : 'pending'">{{ __('Help employers know your professional level') }}</div>
                    </div>
                </div>
            </div>

            {{-- Step counter --}}
            <div class="mt-12 text-slate-500 text-xs font-semibold tracking-wider" x-text="`${step} / 3`"></div>
        </div>
    </div>

    {{-- ════════ RIGHT/LEFT: Form Panel ════════ --}}
    <div class="cp-form-side">
        <div class="w-full max-w-2xl mx-auto">

            {{-- Mobile logo & Language switcher --}}
            <div class="flex justify-between items-center mb-6">
                <div class="md:hidden">
                    <img src="{{ asset('images/logo.svg') }}" alt="Malak Careers" class="h-10 filter brightness-0 invert opacity-90 drop-shadow-2xl">
                </div>
                <div class="ms-auto flex items-center gap-1.5 bg-[#112235] p-1.5 rounded-xl border border-[#23364A] shadow-md">
                    <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded-lg text-xs font-bold transition-all {{ app()->getLocale() == 'en' ? 'bg-teal-500 text-white shadow-sm' : 'text-slate-400 hover:text-white' }}">EN</a>
                    <a href="{{ route('lang.switch', 'ar') }}" class="px-3 py-1 rounded-lg text-xs font-bold transition-all {{ app()->getLocale() == 'ar' ? 'bg-teal-500 text-white shadow-sm' : 'text-slate-400 hover:text-white' }}">العربية 🌐</a>
                </div>
            </div>

            <div class="glass-card">
                {{-- Progress bar --}}
                <div class="prog-bar">
                    <div class="prog-fill" :style="`width: ${(step/3)*100}%`"></div>
                </div>

                {{-- Errors --}}
                @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20">
                    <ul class="text-red-400 text-sm space-y-1.5 ltr:text-left rtl:text-right">
                        @foreach($errors->all() as $error)
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            <span>{{ $error }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('profile.complete.save') }}" id="cp-form" enctype="multipart/form-data">
                    @csrf

                    {{-- ══ STEP 1 ══ --}}
                    <div class="step-panel" :class="step === 1 ? 'active' : ''">
                        <div class="mb-6 text-start">
                            <div class="google-badge">
                                <span class="text-teal-400">🌐</span>
                                <span>{{ $user->first_name }} · {{ $user->email }}</span>
                            </div>
                            <h2 class="text-white text-xl font-bold">{{ __('Personal Information') }}</h2>
                            <p class="text-slate-400 text-sm mt-1">{{ __('Basic details about you') }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="cp-label">{{ __('First Name') }} <span class="text-red-400">*</span></label>
                                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="{{ __('First Name') }}" class="cp-input" required>
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Last Name') }} <span class="text-red-400">*</span></label>
                                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="{{ __('Last Name') }}" class="cp-input" required>
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Phone Number') }} <span class="text-red-400">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+20 10 0000 0000" class="cp-input" dir="ltr" required>
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Gender') }} <span class="text-red-400">*</span></label>
                                <select name="gender" class="cp-input" required>
                                    <option value="" disabled {{ old('gender',$user->gender) ? '' : 'selected' }}>{{ __('Select gender') }}</option>
                                    <option value="male"   {{ old('gender',$user->gender)=='male'   ? 'selected' : '' }}>{{ __('Male') }}</option>
                                    <option value="female" {{ old('gender',$user->gender)=='female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Date of Birth') }} <span class="text-red-400">*</span></label>
                                <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date?->format('Y-m-d')) }}" class="cp-input" dir="ltr" required>
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Nationality') }} <span class="text-red-400">*</span></label>
                                <input type="text" name="nationality" value="{{ old('nationality',$user->nationality) }}" placeholder="{{ __('e.g. Egyptian') }}" class="cp-input" required>
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Religion') }} <span class="text-slate-500 text-xs">({{ __('Optional') }})</span></label>
                                <select name="religion" class="cp-input">
                                    <option value="" {{ old('religion',$user->religion) ? '' : 'selected' }}>{{ __('Select Religion') }}</option>
                                    <option value="Muslim"    {{ old('religion',$user->religion)=='Muslim'    ? 'selected':'' }}>{{ __('Muslim') }}</option>
                                    <option value="Christian" {{ old('religion',$user->religion)=='Christian' ? 'selected':'' }}>{{ __('Christian') }}</option>
                                    <option value="Other"     {{ old('religion',$user->religion)=='Other'     ? 'selected':'' }}>{{ __('Other') }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="cp-label">{{ __('City / Location') }} <span class="text-slate-500 text-xs">({{ __('Optional') }})</span></label>
                                <input type="text" name="location" value="{{ old('location',$user->location) }}" placeholder="{{ __('e.g. Cairo, Egypt') }}" class="cp-input">
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Father of Confession') }} <span class="text-slate-500 text-xs">({{ __('Optional') }})</span></label>
                                <input type="text" name="confession_father" value="{{ old('confession_father',$user->confession_father) }}" placeholder="{{ __('Father of Confession') }}" class="cp-input">
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Applicant Church') }} <span class="text-slate-500 text-xs">({{ __('Optional') }})</span></label>
                                <input type="text" name="applicant_church" value="{{ old('applicant_church',$user->applicant_church) }}" placeholder="{{ __('Applicant Church') }}" class="cp-input">
                            </div>
                        </div>

                        <div class="flex justify-end mt-8">
                            <button type="button" @click="step=2" class="btn-gradient inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white shadow-lg cursor-pointer">
                                <span>{{ __('Next') }}</span>
                                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- ══ STEP 2 ══ --}}
                    <div class="step-panel" :class="step === 2 ? 'active' : ''">
                        <div class="mb-6 text-start">
                            <h2 class="text-white text-xl font-bold">{{ __('Education') }}</h2>
                            <p class="text-slate-400 text-sm mt-1">{{ __('Your academic background') }}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label class="cp-label">{{ __('Education Status') }} <span class="text-red-400">*</span></label>
                                <select name="education_status" class="cp-input" required>
                                    <option value="" disabled {{ old('education_status',$user->education_status) ? '' : 'selected' }}>{{ __('Select Status') }}</option>
                                    <option value="studying"  {{ old('education_status',$user->education_status)=='studying'  ? 'selected':'' }}>{{ __('Currently Studying') }}</option>
                                    <option value="graduated" {{ old('education_status',$user->education_status)=='graduated' ? 'selected':'' }}>{{ __('Graduated') }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="cp-label">{{ __('Education Degree / Field') }} <span class="text-red-400">*</span></label>
                                <input type="text" name="education_degree" value="{{ old('education_degree',$user->education_degree) }}" placeholder="{{ __('e.g. Computer Science, BSc') }}" class="cp-input" required>
                            </div>
                        </div>

                        <div class="flex justify-between mt-8">
                            <button type="button" @click="step=1" class="btn-back">
                                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                <span>{{ __('Back') }}</span>
                            </button>
                            <button type="button" @click="step=3" class="btn-gradient inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white shadow-lg cursor-pointer">
                                <span>{{ __('Next') }}</span>
                                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- ══ STEP 3 ══ --}}
                    <div class="step-panel" :class="step === 3 ? 'active' : ''">
                        <div class="mb-6 text-start">
                            <h2 class="text-white text-xl font-bold">{{ __('Career Profile') }}</h2>
                            <p class="text-slate-400 text-sm mt-1">{{ __('Help employers know your professional level') }}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-5">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="cp-label">{{ __('Years of Experience (in years)') }} <span class="text-red-400">*</span></label>
                                    <input type="number" min="0" max="50" name="years_of_experience" value="{{ old('years_of_experience',$user->years_of_experience) }}" placeholder="0" class="cp-input" dir="ltr" required>
                                </div>
                                <div>
                                    <label class="cp-label">{{ __('Target Headline') }} <span class="text-slate-500 text-xs">({{ __('Optional') }})</span></label>
                                    <input type="text" name="headline" value="{{ old('headline',$user->headline) }}" placeholder="{{ __('e.g. Full-Stack Developer') }}" class="cp-input">
                                </div>
                            </div>

                            <div>
                                <label class="cp-label">{{ __('LinkedIn Profile URL') }} <span class="text-slate-500 text-xs">({{ __('Optional') }})</span></label>
                                <input type="url" name="linkedin_url" value="{{ old('linkedin_url',$user->linkedin_url) }}" placeholder="https://linkedin.com/in/yourname" class="cp-input" dir="ltr">
                            </div>

                            {{-- CV Upload --}}
                            <div>
                                <label class="cp-label">{{ __('Upload CV (PDF, DOC, DOCX)') }} <span class="text-red-400">*</span></label>
                                <label class="block cursor-pointer group">
                                    <div class="flex flex-col items-center justify-center gap-3 p-5 rounded-xl border-2 border-dashed border-[#23364A] bg-[#081B29]/50 hover:border-teal-500/50 hover:bg-teal-950/10 transition-all" id="cv-drop-zone">
                                        <div class="w-10 h-10 rounded-full bg-teal-950/50 text-teal-400 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        </div>
                                        <div class="text-center">
                                            <span class="text-xs font-bold text-white block" id="cv-filename">{{ __('Click to upload your CV') }}</span>
                                            <p class="text-[11px] text-slate-500 mt-0.5">{{ __('PDF, DOC, DOCX · Max 10MB') }}</p>
                                        </div>
                                    </div>
                                    <input type="file" name="cv" accept=".pdf,.doc,.docx" class="sr-only" id="cv-input" onchange="document.getElementById('cv-filename').textContent = this.files[0]?.name || '{{ __('Click to upload your CV') }}'" required>
                                </label>
                            </div>

                            {{-- Recommendation Letter Upload --}}
                            <div>
                                <label class="cp-label">{{ __('Upload Recommendation Letter') }} <span class="text-slate-500 text-xs">({{ __('Optional') }})</span></label>
                                <label class="block cursor-pointer group">
                                    <div class="flex flex-col items-center justify-center gap-3 p-5 rounded-xl border-2 border-dashed border-[#23364A] bg-[#081B29]/50 hover:border-amber-500/50 hover:bg-amber-950/10 transition-all" id="rec-drop-zone">
                                        <div class="w-10 h-10 rounded-full bg-amber-950/50 text-amber-400 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div class="text-center">
                                            <span class="text-xs font-bold text-slate-300 block" id="rec-filename">{{ __('Upload Recommendation Letter') }}</span>
                                            <p class="text-[11px] text-slate-500 mt-0.5">{{ __('PDF, DOC, JPG, PNG · Max 10MB') }}</p>
                                        </div>
                                    </div>
                                    <input type="file" name="recommendation_letter" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="sr-only" onchange="document.getElementById('rec-filename').textContent = this.files[0]?.name || '{{ __('Upload Recommendation Letter') }}'">
                                </label>
                            </div>

                        </div>

                        <div class="info-card mt-5 text-start">
                            <div class="flex items-center gap-2 text-teal-400 text-sm font-semibold mb-1">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-bold">{{ __('Almost Done!') }}</span>
                            </div>
                            <p class="text-slate-400 text-xs leading-relaxed">{{ __('By submitting, your profile will be activated and you can start applying for jobs on Malak Careers.') }}</p>
                        </div>

                        <div class="flex justify-between mt-8">
                            <button type="button" @click="step=2" class="btn-back">
                                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                <span>{{ __('Back') }}</span>
                            </button>
                            <button type="submit" class="btn-gradient inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white shadow-lg cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ __('Complete Profile & Continue') }}</span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <p class="text-slate-500 text-xs mt-8 text-center">
                {{ __('You can update these details anytime from your') }}
                <a href="{{ route('profile.edit') }}" class="text-teal-400 hover:text-teal-300 hover:underline font-semibold ms-1">{{ __('profile settings') }}</a>
            </p>
        </div>
    </div>
</div>

<script>
    function wizard() {
        return { 
            step: 1
        }
    }
</script>
</body>
</html>
