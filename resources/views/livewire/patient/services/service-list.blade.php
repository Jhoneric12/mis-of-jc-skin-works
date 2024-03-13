<div>
    <x-Essentials.page-title>Services</x-Essentials.page-title>

    {{-- Added Message --}}
    <x-action-message on="created" class="w-full text-white bg-green-500 rounded-lg mb-4">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <p class="mx-3 text-white">Scheduled successfully.</p>
            </div>
        </div>
    </x-action-message>

    <div class="grid grid-rows-3 grid-cols-3 gap-4">
        @foreach ($services as $service)
            <div class="bg-white rounded-lg p-6 shadow-md flex flex-col gap-2">
                <p class="font-semibold ">{{$service->service_name}}</p>
                <h1 class="mt-auto text-[#4FBD5E] font-bold text-lg">{{$service->price}}</h1>
                <p class="text-xs">{{$service->description}}</p>
                <button wire:click='add({{$service->id}})' class="bg-[#4FBD5E] text-white rounded-md mt-auto py-1 text-sm hover:opacity-90 ">Book Appointment</button>
            </div>
        @endforeach
    </div>

     {{-- Add Modal --}}
     <x-dialog-modal wire:model.live="modalAdd" maxWidth='lg'>
        <x-slot name="title">
            {{ __('New Appointment') }}
        </x-slot>
    
        <x-slot name="content">
            <form wire:submit='create'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        {{-- <div class="flex gap-4">
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('First Name') }}" />
                                <input wire:model="first_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="first_name"/>
                            </div>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Middle Name') }}" />
                                <input wire:model="middle_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="middle_name"/>
                            </div>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Last Name') }}" />
                                <input wire:model="last_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="last_name"/>
                            </div>
                        </div> --}}
                        <div class='flex flex-col gap-4 mb-4 w-full'>
                            <div class="w-full">
                                <x-label for="" value="{{ __('Service Name') }}" />
                                <select wire:model='service_id' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                        <div class='w-full flex flex-col '>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Date') }}" />
                                <input wire:model="date" type="date"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="date"/>
                            </div>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Time') }}" />
                                <input wire:model="time" type="time"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
    
            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='create'>
                {{ __('Add') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
