<div>
    <div class="flex gap-4 items-center">
        <a href="{{route('staff-manage-patients')}}">
            <x-Essentials.page-title class="text-border-color">Patients</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-border-color"> > </x-Essentials.page-title>
        <x-Essentials.page-title>Add New Patient </x-Essentials.page-title>
    </div>

    <form wire:submit.prevent='createPatient' class='bg-gray-50 p-10 border border-solid border-t-4 border-t-[#5FC26C] border-t-solid shadow-md rounded-lg'>
        @csrf
        <div class='flex gap-4 w-full'>
            <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                <x-label for="firstname" value="{{ __('First Name') }}" />
                <x-input wire:model='firstname' id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"  autofocus autocomplete="firstname" />
                <x-input-error for="firstname"/>
            </div>
            <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                <x-label for="middlename" value="{{ __('Middle Name') }}" />
                <x-input wire:model='middlename' id="middlename" class="block mt-1 w-full" type="text" name="middlename" :value="old('middlename')"  autofocus autocomplete="middlename" />
                <x-input-error for="middlename"/>
            </div>
            <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                <x-label for="lastname" value="{{ __('Last Name') }}" />
                <x-input wire:model='lastname' id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"  autofocus autocomplete="lastname" />
                <x-input-error for="lastname"/>
            </div>
        </div>
        <div class='flex gap-4 items-center'>
            <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                <x-label for="birthdate" value="{{ __('Birth Date') }}" />
                <x-input wire:model='bDate' id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('bDate')"  autofocus autocomplete="birthdate" />
                <x-input-error for="bDate"/>
            </div>
            <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                <x-label for="age" value="{{ __('Age') }}" />
                <x-input wire:model='age' id="age" class="block mt-1 w-full" type="text" name="age" :value="old('age')"  autofocus autocomplete="age" />
                <x-input-error for="age"/>
            </div>
            <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                <x-label for="" value="{{ __('Gender') }}" />
                <select wire:model='gender' name="gender" id="gender" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm'">
                    <option value="">- Select Options -</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <x-input-error for="gender"/>
            </div>
        </div>
        <div class='flex gap-4 w-full items-center'>
            <div class='flex flex-col gap-1 mb-4 w-[50%]'>
                <x-label for="" value="{{ __('Civil Status') }}" />
                <select wire:model='civilstatus' name="civilstatus" id="civilstatus" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm'">
                    <option value="">- Select Options -</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Divorced">Divorced</option>
                </select>
                <x-input-error for="civilstatus"/>
            </div>
            <div class='flex flex-col gap-1 mb-4 w-[50%]'>
                <x-label for="religion" value="{{ __('Religion') }}" />
                <x-input wire:model='religion' id="religion" class="block mt-1 w-full" type="text" name="religion" :value="old('religion')"  autofocus autocomplete="religion" />
                <x-input-error for="religion"/>
            </div>
        </div>
        <div class='w-full'>
            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                <x-label for="" value="{{ __('Home Address') }}" />
                <textarea wire:model='homeaddress' cols="30" rows="3" name="homeaddress" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" placeholder='Enter Home Address' '></textarea>
                <x-input-error for="homeaddress"/>
            </div>
        </div>
        <div class='flex gap-4 w-full'>
            <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                <x-label for="contactnumber" value="{{ __('Contact Number') }}" />
                <x-input wire:model='contactnumber' id="contactnumber" class="block mt-1 w-full" type="text" name="contactnumber" :value="old('contactnumber')"  autofocus autocomplete="contactnumber" />
                <x-input-error for="contactnumber"/>
            </div>
            <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                <x-label for="emailaddress" value="{{ __('Email Address') }}" />
                <x-input wire:model='emailaddress' id="emailaddress" class="block mt-1 w-full" type="text" name="emailaddress" :value="old('emailaddress')"  autofocus autocomplete="emailaddress" />
                <x-input-error for="emailaddress"/>
            </div>
        </div>
        <div class="w-full">
            <x-label for="skintype" value="{{ __('Skin Type') }}" />
            <select wire:model="skintype" id="skintype" class="w-full mt-1 text-base border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm mt-1'">
                <option value="">- Select Options - </option>
                <option value="NORMAL">Normal</option>
                <option value="OILY">Oily</option>
                <option value="DRY">Dry</option>
                <option value="COMBINATION">Combination</option>
                <option value="SENSITIVE">Sensitive</option>
                <option value="ACNE-PRONE">Acne-Prone</option>
            </select>
            <x-input-error for="skintype"/>
        </div>
        <div class='mb-4'>
            <p class='text-[red] text-xs'></p>
        </div>
        <div class='flex justify-end mt-6 items-center'>

            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>

            <button type="submit" class="text-sm text-center bg-[#4FBD5E] hover:opacity-90 text-white px-10 py-3 rounded-[8px]">Submit</button>
        </div>
    </form>
</div>

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
