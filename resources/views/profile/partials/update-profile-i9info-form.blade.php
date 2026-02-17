<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Form I-9') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your profile's I-9 information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.i9update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        {{-- Personal Details --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t pt-4">
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->profile->first_name ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <div>
                <x-input-label for="middle_initial" :value="__('M.I.')" />
                <x-text-input id="middle_initial" name="middle_initial" type="text" maxlength="2" class="mt-1 block w-full" :value="old('middle_initial', $user->profile->middle_initial ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('middle_initial')" />
            </div>

            <div>
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->profile->last_name ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="other_last_names" :value="__('Other Last Names Used (if any)')" />
            <x-text-input id="other_last_names" name="other_last_names" type="text" class="mt-1 block w-full" :value="old('other_last_names', $user->profile->other_last_names ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('other_last_names')" />
        </div>
        {{-- Contact & Address --}}
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 border-t pt-4">
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->profile->phone ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-3">
                <x-input-label for="street_address" :value="__('Street Address')" />
                <x-text-input id="street_address" name="street_address" type="text" class="mt-1 block w-full" :value="old('street_address', $user->profile->street_address ?? '')" />
            </div>
            <div>
                <x-input-label for="apt" :value="__('Apt')" />
                <x-text-input id="apt" name="apt" type="text" class="mt-1 block w-full" :value="old('apt', $user->profile->apt ?? '')" />
            </div>
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->profile->city ?? '')" />
            </div>
            <div>
                <x-input-label for="state" :value="__('State')" />
                <select id="state" name="state" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">-- {{ __('Select State') }} --</option>
                    @foreach([
                        'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 
                        'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 
                        'DC' => 'District of Columbia', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 
                        'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 
                        'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 
                        'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 
                        'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 
                        'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 
                        'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 
                        'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 
                        'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 
                        'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 
                        'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming'
                    ] as $code => $name)
                        <option value="{{ $code }}" {{ old('state', $user->profile->state ?? '') == $code ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>
            <div>
                <x-input-label for="zip" :value="__('Zip Code')" />
                <x-text-input id="zip" name="zip" type="text" class="mt-1 block w-full" :value="old('zip', $user->profile->zip ?? '')" />
            </div>
        </div>
        {{-- Sensitive & Legal Info --}}
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 border-t pt-4">
            <div>
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $user->profile->date_of_birth ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
            </div>

            <div>
                <x-input-label for="ssn" :value="__('Social Security Number (SSN)')" />
                <x-text-input id="ssn" name="ssn" type="text" placeholder="XXX-XX-XXXX" class="mt-1 block w-full" :value="old('ssn', $user->profile->ssn ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('ssn')" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="status" :value="__('Citizenship Status')" />
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Select Status</option>
                @foreach(['U.S. Citizen', 'Noncitizen National', 'Lawful Permanent Resident', 'Alien Authorized to Work'] as $option)
                    <option value="{{ $option }}" {{ old('status', $user->profile->status ?? '') == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="uscis_a_number" :value="__('USCIS A-Number')" />
                <x-text-input id="uscis_a_number" name="uscis_a_number" type="text" class="mt-1 block w-full" :value="old('uscis_a_number', $user->profile->uscis_a_number ?? '')" />
            </div>
            <div>
                <x-input-label for="i94_admission_number" :value="__('I-94 Admission Number')" />
                <x-text-input id="i94_admission_number" name="i94_admission_number" type="text" class="mt-1 block w-full" :value="old('i94_admission_number', $user->profile->i94_admission_number ?? '')" />
            </div>
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="passport_number" :value="__('Passport Number')" />
                <x-text-input id="passport_number" name="passport_number" type="text" class="mt-1 block w-full" :value="old('passport_number', $user->profile->passport_number ?? '')" />
            </div>
            <div>
                <x-input-label for="passport_country" :value="__('Passport Country')" />
                <x-text-input id="passport_country" name="passport_country" type="text" class="mt-1 block w-full" :value="old('passport_country', $user->profile->passport_country ?? '')" />
            </div>
            <div>
                <x-input-label for="work_authorization_expiration" :value="__('Work Authorization Expiration')" />
                <x-text-input id="work_authorization_expiration" name="work_authorization_expiration" type="date" class="mt-1 block w-full" :value="old('work_authorization_expiration', $user->profile->work_authorization_expiration ?? '')" />
            </div>
        </div>
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

    </style>
    <script type="text/javascript">

    </script>
</section>
