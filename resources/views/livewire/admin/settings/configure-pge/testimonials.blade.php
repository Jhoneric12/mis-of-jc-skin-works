<div>
    <div class="flex gap-4">
        <a href="{{route('contents')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">Configure Page</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-[#9D9D9D]"> > </x-Essentials.page-title>
        <x-Essentials.page-title>Testimonials </x-Essentials.page-title>
    </div>

    {{-- Added Message --}}
    <x-action-message on="created" class="w-full text-white bg-green-500 rounded-lg mb-4">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <p class="mx-3 text-white">Added successfully.</p>
            </div>
        </div>
    </x-action-message>

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

    <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                <tr>
                    <th scope="col" class="px-6 py-6">
                        Patient
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Review
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Rating
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
                @forelse ($testimonials as $testimonial)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $testimonial->patient )
                        <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $testimonial->patient->profile_photo_url }}" alt="{{ $testimonial->patient->name }}"> </div>
                        <div class="ml-4">
                            <div class="text-xs font-medium text-gray-900"> {{ $testimonial->patient->first_name .  " " . $testimonial->patient->last_name }} </div>
                            <div class="text-xs text-gray-500"> {{ $testimonial->patient->email }} </div>
                        </div>
                        @else
                            <div>
                                <div class="text-sm font-medium text-gray-900"> {{ $testimonial->first_name . " " . $testimonial->last_name }} </div>
                                {{-- <div class="text-xs text-gray-500"> {{ $appointment->email }} </div> --}}
                            </div>
                        @endif
                    </th>
                    <td scope="row" class="px-6 py-4 font-medium  whitespace-normal dark:text-white">
                        {{$testimonial->patient->home_address}}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium  whitespace-normal dark:text-white">
                        {{$testimonial->message}}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                        <div class="rating rating-sm">
                            <input wire:model='rating' value="1" type="radio" name="rating-{{$testimonial->id}}" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" {{$testimonial->rating == 1 ? 'checked' : ''}} @disabled(true) />
                            <input wire:model='rating' value="2" type="radio" name="rating-{{$testimonial->id}}" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" {{$testimonial->rating == 2 ? 'checked' : ''}} @disabled(true) />
                            <input wire:model='rating' value="3" type="radio" name="rating-{{$testimonial->id}}" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" {{$testimonial->rating == 3 ? 'checked' : ''}} @disabled(true) />
                            <input wire:model='rating' value="4" type="radio" name="rating-{{$testimonial->id}}" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" {{$testimonial->rating == 4 ? 'checked' : ''}} @disabled(true) />
                            <input wire:model='rating' value="5" type="radio" name="rating-{{$testimonial->id}}" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" {{$testimonial->rating == 5 ? 'checked' : ''}} @disabled(true) />
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <span class="{{ $testimonial->status == false ? 'bg-red-300 text-red-800 text-xs' : 'bg-green-300 text-green-800 text-xs' }} px-2 py-1 rounded-full text-white">
                            {{ $testimonial->status ? 'Active' : 'Inactive'}}
                        </span>
                    </td>
                    <td class="py-6 flex gap-2 items-center">                             
                        <svg wire:click='editStatus({{$testimonial->id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
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
            {{$testimonials->links()}}
        </div>
    </div>

    {{-- Add Modal --}}
    <x-dialog-modal wire:model.live="modalAdd" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Add Testimonials') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit='create'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Name') }}" />
                            <input wire:model="name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="name"/>
                        </div>
                        <div class='w-full'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                                <x-label for="" value="{{ __('Address') }}" />
                                <textarea wire:model='address' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Address' '></textarea>
                                <x-input-error for="address"/>
                            </div>
                        </div>
                        <div class='w-full'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                                <x-label for="" value="{{ __('Review') }}" />
                                <textarea wire:model='review' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Review' '></textarea>
                                <x-input-error for="review"/>
                            </div>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Image') }}" />
                            <input wire:model="image" type="file"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="image"/>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
    
            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='create'>
                {{ __('Add') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Update Modal --}}
    <x-dialog-modal wire:model.live="modalUpdate" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Edit Testimonials') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit='update'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Name') }}" />
                            <input wire:model="name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="name"/>
                        </div>
                        <div class='w-full'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                                <x-label for="" value="{{ __('Address') }}" />
                                <textarea wire:model='address' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Address' '></textarea>
                                <x-input-error for="address"/>
                            </div>
                        </div>
                        <div class='w-full'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                                <x-label for="" value="{{ __('Review') }}" />
                                <textarea wire:model='review' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Review' '></textarea>
                                <x-input-error for="review"/>
                            </div>
                        </div>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Image') }}" />
                            <input wire:model="image" type="file"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="image"/>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
    
            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='update'>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Update Status --}}
    <x-dialog-modal wire:model.live="modalStatus" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Edit testimonial status for ' . $name) }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit='updateStatus'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class="flex gap-4">
                            <div class='flex flex-col gap-1 mb-4 w-full'>
                                <x-label for="" value="{{ __('Status') }}" />
                                <select wire:model='status' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option  value="">- Select Options - </option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>   
                                <x-input-error for="status"/>
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

            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='updateStatus'>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
