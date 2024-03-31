<div>
    <div class="flex gap-4">
        <a href="{{route('appointment-calendar')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">Appointment Calendar</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-[#9D9D9D]"> > </x-Essentials.page-title>
        <x-Essentials.page-title>View Appointment</x-Essentials.page-title>
    </div>

    {{-- Updated Message --}}
    <x-action-message on="updated-appointment" class="w-full text-white bg-green-500 rounded-lg mb-4">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <p class="mx-3 text-white">Updated successfully.</p>
            </div>
        </div>
    </x-action-message>

    <div @if($status == 'Completed') style="display:none" @endif class="flex flex-end">
        <div class="flex gap-4 items-center">
            <div class="flex justify-between" @if($status != 'On-going' || !\Carbon\Carbon::parse($appointment_date)->isToday()) style="display:none" @endif >
                <div></div>
                <div>
                    <a href="{{route('billing', ['appointment_id' => $app_id])}}">
                        <x-button class="flex gap-2" wire:loading.attr="disabled">
                            <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>                
                            {{ __('Proceed to payment') }}
                        </x-button>
                    </a>
                </div>
            </div>

            <div class="flex justify-between" @if($status != 'On-going') style="display:none" @endif >
                <div></div>
                <div>
                    <a href="{{route('session-progress', ['appointment_id' => $app_id, 'isProceed' => true])}}">
                        <x-secondary-button class="flex gap-2" wire:loading.attr="disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                              </svg>
                                             
                            {{ __('Session progress') }}
                        </x-button>
                    </a>
                </div>
            </div>
        
            <div class="flex justify-between" @if($status != 'Cancelled' && $status != 'Confirmed' && $status != 'On-going') style="display:none" @endif >
                <div></div>
                <div>
                    <x-button wire:click='editModal({{$appointment_id}})' class="flex gap-2 bg-red-500 focus:bg-red-500 focus:outline-red-500" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                          </svg>
                                        
                        {{ __('Re-Schedule') }}
                    </x-button>
                </div>
            </div>
        
            <div class="flex justify-between" @if($status != 'Confirmed' || !\Carbon\Carbon::parse($appointment_date)->isToday()) style="display:none" @endif >
                <div></div>
                <div>
                    <x-button wire:click='startSession' class="flex gap-2" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                          </svg>
                                        
        
                        {{ __('Start Session') }}
                    </x-button>
                </div>
            </div>
            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    
    </div>
    <div class="main-container flex flex-col gap-6 mt-6">
        <div class="flex gap-4">
            <div class="card border border-solid border-gray-400 rounded-lg w-1/2">
                <div class="header px-5 py-4 border-b border-b-solid border-b-gray-400">
                    <div class="flex gap-4 items-center">
                        <h1 class="text-gray-800 font-bold text-base">Patient</h1>
                        <span>
                            @if($status == 'Scheduled')
                                <span class="bg-gray-300 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $status }}
                                </span>
                            @elseif($status == 'Cancelled')
                                <span class="bg-red-300 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $status }}
                                </span>
                            @elseif($status == 'Completed')
                                <span class="bg-green-300 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $status }}
                                </span>
                            @elseif($status == 'Confirmed')
                                <span class="bg-blue-300 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $status }}
                                </span>
                            @elseif($status == 'On-going')
                                <span class="bg-[#C7A7EA] text-white text-xs px-2 py-1 rounded-full">
                                    {{ $status }}
                                </span>
                            @else
                                <span class="bg-gray-300 text-gray-800 text-xs px-2 py-1 rounded-full">
                                    {{ $status }}
                                </span>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="content flex gap-20 px-5 py-8">
                    <div>
                        <div class="flex flex-col text-center text-gray-700">
                            <h1 class="text-lg font-bold">{{$app_id}}</h1>
                            <p class="text-sm font-medium">Appointment ID</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="flex flex-col text-center text-gray-700">
                                <h1 class="text-lg font-bold">{{$patient_name}}</h1>
                                <p class="text-sm font-medium">Patient Name</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border border-solid border-gray-400 rounded-lg w-1/2">
                <div class="header px-5 py-4 border-b border-b-solid border-b-gray-400">
                    <h1 class="text-gray-800 font-bold text-base">Date and Time</h1>
                </div>
                <div class="content flex gap-20 px-5 py-8">
                    <div>
                        <div class="flex flex-col text-center text-gray-700">
                            <h1 class="text-lg font-bold">{{\Carbon\Carbon::parse($date)->format('M, d, Y')}}</h1>
                            <p class="text-sm font-medium">Date</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="flex flex-col text-center text-gray-700">
                                <h1 class="text-lg font-bold">{{\Carbon\Carbon::parse($time)->format('g: i a')}}</h1>
                                <p class="text-sm font-medium">Time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card border border-solid border-gray-400 rounded-lg w-full">
                <div class="header px-5 py-4 border-b border-b-solid border-b-gray-400">
                    <h1 class="text-gray-800 font-bold text-base">Service</h1>
                </div>
                <div class="content flex gap-20 px-5 py-8">
                    <div>
                        <div class="flex flex-col text-center text-gray-700">
                            <h1 class="text-lg font-bold">{{$service_id}}</h1>
                            <p class="text-sm font-medium">Service ID</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="flex flex-col text-center text-gray-700">
                                <h1 class="text-lg font-bold">{{$service_name}}</h1>
                                <p class="text-sm font-medium">Service Name</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card border border-solid border-gray-400 rounded-lg w-full">
                <div class="header px-5 py-4 border-b border-b-solid border-b-gray-400">
                    <h1 class="text-gray-800 font-bold text-base">Specialist</h1>
                </div>
                <div class="content flex gap-20 px-5 py-8">
                    <div>
                        <div class="flex flex-col text-center text-gray-700">
                            <h1 class="text-lg font-bold">{{$specialist}}</h1>
                            <p class="text-sm font-medium">Specialist Name</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Update Modal --}}
    <x-dialog-modal wire:model.live="modalUpdate" maxWidth='4xl'>
        <x-slot name="title">
            {{ __('Edit Appointment') }}
        </x-slot>
    
        <x-slot name="content">
            <form wire:submit='update'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class="flex gap-4">
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('First Name') }}" />
                                <input disabled wire:model="first_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="first_name"/>
                            </div>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Middle Name') }}" />
                                <input disabled wire:model="middle_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="middle_name"/>
                            </div>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Last Name') }}" />
                                <input disabled wire:model="last_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="last_name"/>
                            </div>
                        </div>
                        <div class='flex gap-4 mb-4 w-full'>
                            <div class="w-full">
                                <x-label for="" value="{{ __('Service Name') }}" />
                                <select wire:model='serve_id' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option  value="">- Select Options - </option>
                                    @foreach ($services as $service)
                                        @if ($service->status == true)
                                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <x-label for="" value="{{ __('Specialist') }}" />
                                <select wire:model='specialist_id' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option  value="">- Select Options - </option>
                                    @foreach ($specialists as $specialist)
                                        @if ($specialist->role == 2 || $specialist->role == 3)
                                            <option value="{{ $specialist->id }}">{{ $specialist->first_name . " " . $specialist->last_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class='w-full flex gap-4'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Date') }}" />
                                <input wire:model="app_date" type="date"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="date"/>
                            </div>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Time') }}" />
                                <input wire:model="app_time" type="time"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="time"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
    
            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='update'>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
