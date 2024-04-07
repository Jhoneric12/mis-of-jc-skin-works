@section('title')

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="py-4">
            <div class="mb-8">
                <x-section-title>
                    <x-slot name="title">{{ __('Sign Up') }}</x-slot>
                    <x-slot name="description">{{ __('Provide Information that is true and correct for medical purposes only') }}</x-slot>
                </x-section-title>
            </div>
            @csrf
            <div class="flex gap-2 flex-col">
                <div>
                    <x-label for="firstname" value="{{ __('First Name') }}" />
                    <x-input id="firstname" class="block mt-1 w-full text-base" type="text" name="firstname" :value="old('name')" required autofocus autocomplete="firstname" />
                </div>
    
                <div>
                    <x-label for="middlename" value="{{ __('Middle Name') }}" />
                    <x-input id="middlename" class="block mt-1 w-full text-base" type="text" name="middlename" :value="old('middlename')"  autofocus autocomplete="middlename" />
                </div>
    
                <div>
                    <x-label for="lastname" value="{{ __('Last Name') }}" />
                    <x-input id="lastname" class="block mt-1 w-full text-base" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                </div>
            </div>
            <div class="flex flex-row gap-2 mt-2">
                <div class="w-[50%]">
                    <x-label for="birthdate" value="{{ __('Birth Date') }}" />
                    <x-input id="birthdate" class="block mt-1 w-full text-base" type="date" name="birthdate" :value="old('birthdate')" required autofocus autocomplete="birthdate" />
                </div>
    
                <div class="w-[50%]">
                    <x-label for="age" value="{{ __('Age') }}" />
                    <x-input id="age" class="block mt-1 w-full text-base" type="text"  name="age" :value="old('age')" required autofocus autocomplete="age" readonly />
                </div>
            </div>
            
            <div class="w-full mt-2">
                <div class="w-full">
                    <x-label for="skintype" value="{{ __('Skin Type') }}" />
                    <select name="skintype" id="skintype" class="w-full mt-1 text-base border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1'">
                        <option value="">- Select Options - </option>
                        <option value="NORMAL">Normal</option>
                        <option value="OILY">Oily</option>
                        <option value="DRY">Dry</option>
                        <option value="COMBINATION">Combination</option>
                        <option value="SENSITIVE">Sensitive</option>
                        <option value="ACNE-PRONE">Acne-Prone</option>
                    </select>
                </div>
            </div>
            <div class="w-full mt-2 flex gap-2">
                <div class="w-[50%]">
                    <x-label for="civilstaus" value="{{ __('Civil Status') }}" />
                    <select name="civilstatus" id="civilstatus" class="w-full text-base border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1'">
                        <option value="">- Select Options - </option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>
                <div class="w-[50%]">
                    <x-label for="gender" value="{{ __('Gender') }}" />
                    <select name="gender" id="gender" class="w-full text-base border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1'">
                        <option value="">- Select Options -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="w-full mt-2">
                <div class="w-full">
                    <x-label for="homeaddress" value="{{ __('Home Address') }}" />
                    <x-input id="homeaddress" class="block mt-1 w-full text-base" type="text" name="homeaddress" :value="old('homeaddress')" required autofocus autocomplete="homeaddress" />
                </div>
            </div>
            <div class="w-full mt-2 flex gap-2">
                <div class="w-[50%]">
                    <x-label for="contactnumber" value="{{ __('Contact Number') }}" />
                    <x-input id="contactnumber" class="block mt-1 w-full text-base" type="text" name="contactnumber" :value="old('contactnumber')" required autofocus autocomplete="contactnumber" />
                </div>
                <div class="w-[50%]">
                    <x-label for="religion" value="{{ __('Religion') }}" />
                    <x-input id="religion" class="block mt-1 w-full text-base" type="text" name="religion" :value="old('religion')" autofocus autocomplete="religion" />
                </div>
            </div>
            <div class="w-full mt-2">
                <div class="w-full">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full text-base" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>
            </div>
            {{-- <div class="w-full mt-2">
                <x-label for="username" value="{{ __('Username') }}" />
                <x-input id="username" class="block mt-1 w-full text-base" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            </div> --}}
            <div class="w-full mt-2">
                <div class="w-full">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full text-base" type="password" name="password" required autocomplete="new-password" />
                </div>
            </div>
            <div class="w-full mt-2">
                <div class="w-full">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full text-base" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>



<script>
         // Calculate Age depending on the birthdate
        document.addEventListener('DOMContentLoaded', function () {

            // Function to calculate age from birthdate
            function calculateAge(birthdate) {
                const today = new Date();
                const birthDate = new Date(birthdate);
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                return age;
            }

            // Event listener for the birthdate input
            const birthdateInput = document.querySelector('input[name="birthdate"]');
            const ageInput = document.querySelector('input[name="age"]');

            birthdateInput.addEventListener('input', function () {
                const age = calculateAge(this.value);
                ageInput.value = age;
            });
        });
</script>