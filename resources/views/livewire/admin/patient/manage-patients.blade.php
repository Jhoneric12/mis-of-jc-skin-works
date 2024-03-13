<div>
    <x-Essentials.page-title>Patients</x-Essentials.page-title>

    {{-- Added Message --}}
    @if(Session::has('created'))
        <div id="alert-success" class="flex items-center p-4 mb-4 rounded-lg bg-green-500 text-white  dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium text-white">
                {{Session::get('created')}}
            </div>
        </div>
    @endif

    {{-- Update Message --}}
    @if(Session::has('updated'))
        <div id="alert-success" class="flex items-center p-4 mb-4 rounded-lg bg-green-500 text-white  dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium text-white">
                {{Session::get('updated')}}
            </div>
        </div>
    @endif

    {{-- PATIENT TABLE --}}
    <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid">
        <div class="mb-4 flex gap-2 items-center justify-between">
            <div class="flex gap-2 items-center w-[80%]">
                <a href="{{route('add-patient')}}">
                    <x-button class="flex gap-2" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                          </svg>                  
                        {{ __('Add New') }}
                    </x-button>
                </a>

                <div class="w-[30%]">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input wire:model.live='search' type='search' id="default-search" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Patient" autocomplete="off">
                    </div>
                </div>
    
                <div class="w-[13%]">
                    <select wire:model.live='filter' name="status" id="status" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm p-3">
                        <option value="All" selected>All</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    
                </div>    

                <div role="status" wire:loading>
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="20%">
                <x-button class="flex gap-2 bg-red-500" wire:click='export'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>                                       
                    {{ __('Export') }}
                </x-button>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                <tr>
                    <th scope="col" class="px-6 py-6">
                        Patient ID
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Patient
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Contact Number
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Birthdate
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$patient->id}}
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $patient->profile_photo_url }}" alt="{{ $patient->name }}"> </div>
                            <div class="ml-4">
                                <div class="text-xs font-medium text-gray-900"> {{ $patient->first_name .  " " . $patient->last_name }} </div>
                                <div class="text-xs text-gray-500"> {{ $patient->email }} </div>
                            </div>
                        @else
                            <div class="ml-4">
                                <div class="text-xs font-medium text-gray-900"> {{ $patient->name }} </div>
                                <div class="text-xs text-gray-500"> {{ $patient->email }} </div>
                            </div>
                        @endif
                    </th>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{$patient->contact_number}}
                    </td>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{\Carbon\Carbon::parse($patient->birth_date)->format('M, d, Y')}}
                    </td>
                    <td class="px-6 py-6">
                        <span class="{{ $patient->account_status == false ? 'bg-red-300 text-red-800 text-xs' : 'bg-green-300 text-green-800 text-xs' }} px-2 py-1 rounded-full text-white">
                            {{ $patient->account_status ? 'Active' : 'Inactive'}}
                        </span>
                    </td>
                    <td class="px-6 py-6 flex gap-2 items-center">
                        <a href="{{route('view-profile', ['patient_id' => $patient->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>                     
                        <a href="{{route('update-profile', ['patient_id' => $patient->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty
                    <tr class="w-full">
                        <td colspan="6" class="text-center py-4">
                            <div class="flex flex-col items-center justify-center">
                                <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-40 w-40">
                                <h1 class="text-md font-semibold mb-2">No Results Found</h1>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-6">
            {{$patients->links()}}
        </div>
    </div>

    <!-- Add Patient Modal -->
    <x-dialog-modal wire:model.live="modalAdd" maxWidth='4xl'>
        <x-slot name="title">
            {{ __('Add Patient') }}
        </x-slot>

        <x-slot name="content">
            <form>
                @csrf
                <div>
                    <div class='flex gap-4 w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('First Name') }}" />
                            <input wire:model="first_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="first_name"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('Middle Name') }}" />
                            <input wire:model="middle_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="middle_name"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('Last Name') }}" />
                            <input wire:model="last_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="last_name"/>
                        </div>
                    </div>
                    <div class='flex gap-4 items-center'>
                        <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                            <x-label for="" value="{{ __('Birth Date') }}" />
                            <input wire:model="birth_date" type="date" name="birth_date"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="birth_date"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                            <x-label for="" value="{{ __('Age') }}" />
                            <input wire:model="age" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="age"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                            <x-label for="" value="{{ __('Gender') }}" />
                            <select wire:model='gender'  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option  value="">- Select Options - </option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class='flex gap-4 w-full items-center'>
                        <div class='flex flex-col gap-1 mb-4 w-[50%]'>
                            <x-label for="" value="{{ __('Civil Status') }}" />
                            <select wire:model='civil_status' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option  value="">- Select Options - </option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                            
                        </div>
                        <div class='flex flex-col gap-1 mb-4 w-[50%]'>
                            <x-label for="" value="{{ __('Religion') }}" />
                            <input wire:model="religion" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="religion"/>
                        </div>
                    </div>
                    <div class='w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                            <x-label for="" value="{{ __('Home Address') }}" />
                            <textarea wire:model='home_address' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Home Address' '></textarea>
                            <x-input-error for="home_address"/>
                        </div>
                    </div>
                    <div class='flex gap-4 w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('Contact Number') }}" />
                            <input wire:model="contact_number" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="contact_number"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('Email Address') }}" />
                            <input wire:model="email" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="email"/>
                        </div>
                    </div>
                    <div class='w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                            <x-label for="" value="{{ __('Skin Type') }}" />
                            <textarea wire:model='skin_type' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Home Address' '></textarea>
                            <x-input-error for="skin_type"/>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='createPatient'>
                {{ __('Add') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Update Patient Modal --}}
    <x-dialog-modal wire:model.live="modalUpdate" maxWidth='4xl'>
        <x-slot name="title">
            {{ __('Edit Patient Information ' . $patient_id) }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit='updatePatient'>
                @csrf
                <div>
                    <div class='flex gap-4 w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('First Name') }}" />
                            <input wire:model="first_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="first_name"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('Middle Name') }}" />
                            <input wire:model="middle_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="middle_name"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('Last Name') }}" />
                            <input wire:model="last_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="last_name"/>
                        </div>
                    </div>
                    <div class='flex gap-4 items-center'>
                        <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                            <x-label for="" value="{{ __('Birth Date') }}" />
                            <input wire:model="birth_date" type="date" name="birth_date"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="birth_date"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                            <x-label for="" value="{{ __('Age') }}" />
                            <input wire:model="age" type="text" name="age" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="age"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 w-[33.33%]'>
                            <x-label for="" value="{{ __('Gender') }}" />
                            <select wire:model='gender'  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option  value="">- Select Options - </option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class='flex gap-4 w-full items-center'>
                        <div class='flex flex-col gap-1 mb-4 w-[50%]'>
                            <x-label for="" value="{{ __('Civil Status') }}" />
                            <select wire:model='civil_status' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option  value="">- Select Options - </option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                            
                        </div>
                        <div class='flex flex-col gap-1 mb-4 w-[50%]'>
                            <x-label for="" value="{{ __('Religion') }}" />
                            <input wire:model="religion" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="religion"/>
                        </div>
                    </div>
                    <div class='w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                            <x-label for="" value="{{ __('Home Address') }}" />
                            <textarea wire:model='home_address' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Home Address' '></textarea>
                            <x-input-error for="home_address"/>
                        </div>
                    </div>
                    <div class='flex gap-4 w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('Contact Number') }}" />
                            <input wire:model="contact_number" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="contact_number"/>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                            <x-label for="" value="{{ __('Email Address') }}" />
                            <input wire:model="email" type="text" disabled class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="email"/>
                        </div>
                    </div>
                    <div class='w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                            <x-label for="" value="{{ __('Skin Type') }}" />
                            <textarea wire:model='skin_type' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Home Address' '></textarea>
                            <x-input-error for="skin_type"/>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='updatePatient'>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
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
       const birthdateInput = document.querySelector('input[name="birth_date"]');
       const ageInput = document.querySelector('input[name="age"]');

       birthdateInput.addEventListener('input', function () {
           const age = calculateAge(this.value);
           ageInput.value = age;
       });
   });
   
   setTimeout(function() {
            document.getElementById('alert-success').style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
</script>
