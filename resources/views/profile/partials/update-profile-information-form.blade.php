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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
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
        <div>
            <div class="mb-3">
                <p class="text-sm mt-2 mr-5 text-gray-800 dark:text-gray-200">Profile Image <input type="file" name="user-photo" id="user-image" class="form-control"></p>
            </div>
        </div>
        <div>
            <div class="mb-3">
                <p class="text-sm mt-2 mb-2 text-gray-800 dark:text-gray-200">Active Avatar</p>
                <img id="showUserImage" src="{{ (!empty($user->photo)) ? url('upload/user_images/'.$user->photo): url('upload/no_image.jpg') }} " class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
            </div>
        </div> <!-- end col -->

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            {{-- @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif --}}
        </div>
    </form>
    <style>
        img#showUserImage {
            box-shadow: 5px 9px 18px;
            border-radius: 50%;
            width: 20%;
            border: 2px solid #dfdfdf;
        }
    </style>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.querySelector('#user-image');
            const displayImage = document.querySelector('#showUserImage');

            imageInput.addEventListener('change', function(e) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    displayImage.setAttribute('src', e.target.result);
                }

                if (e.target.files && e.target.files[0]) {
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        });
    </script>
</section>
