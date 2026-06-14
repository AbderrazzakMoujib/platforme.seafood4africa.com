<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Raison Sociale --}}
        <div>
            <x-input-label for="raison_social" :value="__('Raison Sociale')" />
            <x-text-input id="raison_social" name="raison_social" type="text" class="mt-1 block w-full"
                :value="old('raison_social', $user->raison_social)" />
            <x-input-error class="mt-2" :messages="$errors->get('raison_social')" />
        </div>

        {{-- Phone --}}
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full"
                :value="old('phone', $user->phone)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        {{-- Description --}}
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea name="description" id="description"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                rows="4">{{ old('description', $user->description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        {{-- Country --}}
        <div>
            <x-input-label for="country_id" :value="__('Country')" />
            <select name="country_id" id="country_id"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">-- {{ __('Select a Country') }} --</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
        </div>

        {{-- Category --}}
        <div>
            <x-input-label for="category_id" :value="__('Catégorie')" />
            <select name="category_id" id="category_id"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">-- {{ __('Select a Category') }} --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $user->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
        </div>

        {{-- Company Logo --}}
        <div>
            <x-input-label for="profile_picture" :value="__('Company Logo')" />
            <div style="display:flex;align-items:center;gap:16px;margin-top:8px;">
                <div id="logo-preview-wrap"
                    style="width:72px;height:72px;border-radius:10px;border:2px dashed #0088cc;overflow:hidden;display:flex;align-items:center;justify-content:center;background:#f0f8ff;flex-shrink:0;">
                    @if($user->profile_picture)
                        <img id="logo-preview" src="{{ asset('storage/' . $user->profile_picture) }}"
                            style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <img id="logo-preview" src="" style="width:100%;height:100%;object-fit:cover;display:none;">
                        <i id="logo-icon" class="fas fa-camera" style="font-size:22px;color:#0088cc;"></i>
                    @endif
                </div>
                <label for="profile_picture" style="cursor:pointer;font-size:13px;color:#0088cc;text-decoration:underline;">
                    {{ $user->profile_picture ? __('Change logo') : __('Upload logo') }}
                </label>
            </div>
            <input type="file" name="profile_picture" id="profile_picture"
                class="mt-1 block w-full" accept="image/*" style="display:none;" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
            <script>
                document.getElementById('profile_picture').addEventListener('change', function () {
                    const file = this.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.getElementById('logo-preview');
                        img.src = e.target.result;
                        img.style.display = 'block';
                        const icon = document.getElementById('logo-icon');
                        if (icon) icon.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                });
            </script>
        </div>

        {{-- Background Image --}}
        <div>
            <x-input-label for="background_image" :value="__('Background Image')" />
            <div style="margin-top:8px;">
                @if($user->background_image)
                    <img src="{{ asset('storage/' . $user->background_image) }}"
                        style="width:100%;max-height:120px;object-fit:cover;border-radius:8px;margin-bottom:8px;">
                @endif
            </div>
            <input type="file" name="background_image" id="background_image"
                class="mt-1 block w-full" accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('background_image')" />
        </div>

        {{-- Save --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>