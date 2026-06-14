<x-guest-layout>
    <style>
        .hidden {
            display: none;
        }

        /* Step indicator */
        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 24px;
        }
        .step-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #9ca3af;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s, color 0.3s;
            flex-shrink: 0;
        }
        .step-dot.active {
            background: #0f6bac;
            color: #fff;
        }
        .step-dot.done {
            background: #16a34a;
            color: #fff;
        }
        .step-line {
            flex: 1;
            height: 2px;
            background: #e5e7eb;
            max-width: 48px;
            transition: background 0.3s;
        }
        .step-line.done {
            background: #16a34a;
        }
    </style>

    <form id="registrationForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step-dot active" id="dot-1">1</div>
            <div class="step-line" id="line-1"></div>
            <div class="step-dot" id="dot-2">2</div>
            <div class="step-line" id="line-2"></div>
            <div class="step-dot" id="dot-3">3</div>
        </div>

        <!-- ───── Step 1 ───── -->
        <div id="step-1">

            <!-- Raison Sociale -->
            <div>
                <x-input-label for="name" :value="__('Raison Sociale')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <div style="position:relative;">
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password" name="password"
                        required autocomplete="new-password"
                        style="padding-right:40px;" />
                    <button type="button"
                        onclick="togglePassword('password','eyeIcon1')"
                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#888;padding:0;line-height:1;">
                        <i id="eyeIcon1" class="fas fa-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <div style="position:relative;">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password" name="password_confirmation"
                        required autocomplete="new-password"
                        style="padding-right:40px;" />
                    <button type="button"
                        onclick="togglePassword('password_confirmation','eyeIcon2')"
                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#888;padding:0;line-height:1;">
                        <i id="eyeIcon2" class="fas fa-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="button" id="nextStep1" class="btn-primary">
                    {{ __('Next') }} &rarr;
                </button>
            </div>
        </div>

        <!-- ───── Step 2 ───── -->
        <div id="step-2" class="hidden">

            <div class="mt-4">
                <x-input-label for="activites_principales" :value="__('Activités Principales')" />
                <textarea id="activites_principales"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    name="activites_principales"
                    rows="3"
                    required>{{ old('activites_principales') }}</textarea>
                <x-input-error :messages="$errors->get('activites_principales')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" class="block mt-1 w-full" type="text"
                    name="adresse" :value="old('adresse')" required />
                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="tel"
                    name="phone" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="site_web" :value="__('Site Web')" />
                <x-text-input id="site_web" class="block mt-1 w-full" type="text"
                    name="site_web" :value="old('site_web')" />
                <x-input-error :messages="$errors->get('site_web')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="button" id="previousStep2" class="btn-gray">
                    &larr; {{ __('Previous') }}
                </button>
                <button type="button" id="nextStep2" class="btn-primary">
                    {{ __('Next') }} &rarr;
                </button>
            </div>
        </div>

        <!-- ───── Step 3 ───── -->
        <div id="step-3" class="hidden">

            <!-- Nom Responsable -->
            <div>
                <x-input-label for="nom_responsable" :value="__('Nom du Responsable')" />
                <x-text-input id="nom_responsable" class="block mt-1 w-full" type="text"
                    name="nom_responsable" :value="old('nom_responsable')" required autocomplete="name" />
                <x-input-error :messages="$errors->get('nom_responsable')" class="mt-2" />
            </div>

            <!-- Country -->
            <div class="mt-4">
                <x-input-label for="country_id" :value="__('Country')" />
                <select name="country_id" id="country_id"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    required>
                    <option value="" disabled selected>{{ __('Select a Country') }}</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
            </div>

            <!-- Category -->
            <div class="mt-4">
                <x-input-label for="category_id" :value="__('Catégorie')" />
                <select name="category_id" id="category_id"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    required>
                    <option value="" disabled selected>{{ __('Select a Category') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <!-- Company Logo -->
            <div class="mt-4">
                <x-input-label for="profile_picture" :value="__('Company Logo')" />
                <div style="margin-top:8px;">
                    <label for="profile_picture" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                        <div id="logo-preview-wrap"
                            style="width:80px;height:80px;border-radius:50%;border:2px dashed #0088cc;overflow:hidden;display:flex;align-items:center;justify-content:center;background:#f0f8ff;flex-shrink:0;">
                            <img id="logo-preview" src="" alt=""
                                style="width:100%;height:100%;object-fit:cover;display:none;" />
                            <i id="logo-icon" class="fas fa-camera" style="font-size:24px;color:#0088cc;"></i>
                        </div>
                        <span style="font-size:13px;color:#666;">{{ __('Click to upload your company logo') }}</span>
                    </label>
                    <input id="profile_picture" name="profile_picture" type="file" accept="image/*" style="display:none;" />
                </div>
                <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="button" id="previousStep3" class="btn-gray">
                    &larr; {{ __('Previous') }}
                </button>
                <button type="submit" class="btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>

    </form>

    <script>
        // ── Toggle password visibility ──────────────────────────────
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // ── Step indicator helper ───────────────────────────────────
        function setStep(step) {
            for (let i = 1; i <= 3; i++) {
                const dot  = document.getElementById('dot-' + i);
                const line = document.getElementById('line-' + i);
                dot.classList.remove('active', 'done');
                if (line) line.classList.remove('done');

                if (i < step) {
                    dot.classList.add('done');
                    if (line) line.classList.add('done');
                } else if (i === step) {
                    dot.classList.add('active');
                }
            }
        }

        // ── Step 1 → 2 ─────────────────────────────────────────────
        document.getElementById('nextStep1').addEventListener('click', function () {
            const name     = document.getElementById('name').value.trim();
            const email    = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const confirm  = document.getElementById('password_confirmation').value.trim();

            const errors = [];
            if (!name)                              errors.push("{{ __('Raison Sociale is required.') }}");
            if (!email || !/^\S+@\S+\.\S+$/.test(email)) errors.push("{{ __('Valid email is required.') }}");
            if (!password)                          errors.push("{{ __('Password is required.') }}");
            if (password !== confirm)               errors.push("{{ __('Passwords do not match.') }}");

            if (errors.length) { alert(errors.join('\n')); return; }

            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');
            setStep(2);
        });

        // ── Step 2 → 3 ─────────────────────────────────────────────
        document.getElementById('nextStep2').addEventListener('click', function () {
            const activites = document.getElementById('activites_principales').value.trim();
            const adresse   = document.getElementById('adresse').value.trim();
            const phone     = document.getElementById('phone').value.trim();

            if (!activites || !adresse || !phone) {
                alert("{{ __('Please complete all required fields.') }}");
                return;
            }

            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-3').classList.remove('hidden');
            setStep(3);
        });

        // ── Step 2 → 1 ─────────────────────────────────────────────
        document.getElementById('previousStep2').addEventListener('click', function () {
            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-1').classList.remove('hidden');
            setStep(1);
        });

        // ── Step 3 → 2 ─────────────────────────────────────────────
        document.getElementById('previousStep3').addEventListener('click', function () {
            document.getElementById('step-3').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');
            setStep(2);
        });

        // ── Logo preview ────────────────────────────────────────────
        document.getElementById('profile_picture').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('logo-preview');
                const icon    = document.getElementById('logo-icon');
                preview.src          = e.target.result;
                preview.style.display = 'block';
                icon.style.display    = 'none';
            };
            reader.readAsDataURL(file);
        });
    </script>

</x-guest-layout>