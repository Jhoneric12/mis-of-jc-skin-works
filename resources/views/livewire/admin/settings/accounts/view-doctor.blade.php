<div>
    <div class="flex gap-4">
        <a href="{{route('user-accounts')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">User Accounts</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-[#9D9D9D]"> > </x-Essentials.page-title>
        <a href="{{route('doctor-accounts')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">Doctor Accounts</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-[#9D9D9D]"> > </x-Essentials.page-title>
        <x-Essentials.page-title>Doctor Profile</x-Essentials.page-title>
    </div>

    {{-- Updated Message --}}
    <x-action-message on="updated" class="w-full text-white bg-green-500 rounded-lg mb-4">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <p class="mx-3 text-white">Updated successfully.</p>
            </div>
        </div>
    </x-action-message>

    <div class="flex justify-between gap-4">
        <div class=' bg-white border border-solid rounded-lg px-4 py-4 border-t-4 border-t-primary-green border-t-solid shadow-md w-[30%]'>
            <div class="flex justify-between px-6 py-4 border-b-2 border-b-[#D0D0D0] font-bold text-center">
                <div class="flex justify-between gap-4">
                    <h1 class="text-md">Staff Information</h1>
                    <span class="{{ $staff->account_status == false ? 'bg-red-300 text-red-800 text-xs' : 'bg-green-300 text-green-800 text-xs' }} px-2 py-1 rounded-full text-white">
                        {{ $staff->account_status ? 'Active' : 'Inactive'}}
                    </span>
                </div>
            </div>
            <div class="flex justify-center p-4 mt-4">
                <div class="flex flex-col justify-center items-center">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 h-28 w-28 shadow-lg rounded-full mb-6"> <img class="h-28 w-28 rounded-full" src="{{ $staff->profile_photo_url }}" alt="{{ $staff->name }}"> </div>
                    @endif
                    <div class='text-sm flex justify-between font-medium'>
                        <h1 class="font-bold text-center text-md">{{$staff->first_name . " " . $staff->middle_name . " " . $staff->last_name}}</h1>
                    </div>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1 class="text-gray-500 font-regular">{{$staff->email}}</h1>
                    </div>
                </div>
            </div>
           <div class=" text-gray">
            <div class='px-6 py-4'> 
                <div class='text-sm flex justify-between font-medium'>
                    <h1>Doctor ID</h1>
                    <h1 class="text-gray-500 font-regular">{{$staff->id}}</h1>
                </div>
            </div>
           <div class='px-6 py-4 border-t border-t-[#D0D0D0]'> 
                <div class='text-sm flex justify-between font-medium'>
                    <h1>License Number</h1>
                    <div class="flex justify-between items-center gap-2">
                        <h1 class="text-gray-500 font-regular">{{$staff->license_number}}</h1>
                        <svg wire:click='editLicense()' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                          </svg>                           
                    </div>
                </div>
           </div>
           </div>
</div>

<div class=" bg-white border border-solid rounded-lg px-4 py-4 border-t-4 border-t-primary-green border-t-solid shadow-md w-[70%] max-h-[530px] overflow-y-auto">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="profile" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Appointments Today</button>
        </li>
        {{-- <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sessions</button>
        </li> --}}
    </ul>
    <div id="default-tab-content">
        {{-- <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div>
                <div class="flex flex-col">
                        @forelse ($sessions as $session)
                            @if ($session->status ==='Completed' || $session->status === 'On-going')
                                <div class="mt-2 flex flex-col gap-4 border-b border-b-[#D0D0D0] py-10 px-4">
                                    <div class="flex gap-1 justify-between">
                                        <div class="flex flex-col justify-between">
                                            <h1 class="text-base">{{$session->service->service_name}}</h1>
                                            <span class="text-xs">Appointment No. {{$session->id}}</span>
                                        </div>
                                        <div>
                                            @if($session->status == 'Scheduled')
                                            <span class="bg-gray-300 text-white text-xs px-2 py-1 rounded-full">
                                                {{ $session->status }}
                                            </span>
                                            @elseif($session->status == 'Cancelled')
                                                <span class="bg-red-300 text-white text-xs px-2 py-1 rounded-full">
                                                    {{ $session->status }}
                                                </span>
                                            @elseif($session->status == 'Completed')
                                                <span class="bg-green-300 text-white text-xs px-2 py-1 rounded-full">
                                                    {{ $session->status }}
                                                </span>
                                            @elseif($session->status == 'Confirmed')
                                                <span class="bg-blue-300 text-white text-xs px-2 py-1 rounded-full">
                                                    {{ $session->status }}
                                                </span>
                                            @elseif($session->status == 'On-going')
                                                <span class="bg-[#C7A7EA] text-white text-xs px-2 py-1 rounded-full">
                                                    {{ $session->status }}
                                                </span>
                                            @else
                                                <span class="bg-gray-300 text-gray-800 text-xs px-2 py-1 rounded-full">
                                                    {{ $session->status }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{route('session-progress', ['appointment_id' => $session->id])}}" class="w-full bg-green-300 p-2 rounded-lg text-green-500 font-bold hover:opacity-90 text-xs text-center">
                                        <button>View Session Progress</button>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class='text-center bg-white rounded-lg p-4'>
                                <div class="flex flex-col items-center justify-center">
                                    <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-40 w-40">
                                    <h1 class="text-sm font-semibold mb-2">No Results Found</h1>
                                </div>
                            </div>
                        @endforelse
                    </div>
               </div>
        </div> --}}
        <div class=" p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile">
            <div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid mt-6">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                        <tr>
                            <th scope="col" class="px-6 py-6">
                                Patient
                            </th>
                            <th scope="col" class="px-6 py-6">
                                Service
                            </th>
                            <th scope="col" class="px-6 py-6">
                                Status
                            </th>
                            {{-- <th scope="col" class="px-6 py-6">
                                Action
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointments as $appointment)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                            <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $appointment->patient->profile_photo_url }}" alt="{{ $appointment->patient->name }}"> </div>
                                    <div class="ml-4">
                                        <div class="text-xs font-medium text-gray-900"> {{ $appointment->patient->first_name .  " " . $appointment->patient->last_name }} </div>
                                        <div class="text-xs text-gray-500"> {{ $appointment->patient->email }} </div>
                                    </div>
                                @else
                                    <div class="ml-4">
                                        <div class="text-xs font-medium text-gray-900"> {{ $appointment->patient->name }} </div>
                                        <div class="text-xs text-gray-500"> {{ $appointment->patient->email }} </div>
                                    </div>
                                @endif
                            </th>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                                {{$appointment->service->service_name}}
                            </td>

                            {{-- <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$record->findings}}
                            </td> --}}
                            <td class="px-6 py-6">
                                @if($appointment->status == 'Scheduled')
                                    <span class="bg-gray-300 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @elseif($appointment->status == 'Cancelled')
                                    <span class="bg-red-300 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @elseif($appointment->status == 'Completed')
                                    <span class="bg-green-300 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @elseif($appointment->status == 'Confirmed')
                                    <span class="bg-blue-300 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @elseif($appointment->status == 'On-going')
                                    <span class="bg-[#C7A7EA] text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @else
                                    <span class="bg-gray-300 text-gray-800 text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @endif
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
                    {{$appointments->links()}}
                </div>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model.live="modalUpdate" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Edit License number') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit='updateStatus'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class="flex gap-4">
                            <div class='flex flex-col gap-1 mb-4 w-full'>
                                <x-label for="" value="{{ __('License Number') }}" />
                                <input wire:model="license_number" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">   
                                <x-input-error for="license_number"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='updateLicense'>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
