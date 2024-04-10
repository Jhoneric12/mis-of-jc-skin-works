<div>
    <x-Essentials.page-title>Home</x-Essentials.page-title>


    <div class="container mx-auto">
        <div class="bg-[#B0E1B6] w-full p-6 md:p-12 rounded-lg shadow-lg mb-6">
            <h1 class="text-base md:text-lg lg:text-xl font-bold">{{ __('Welcome') }} {{$patientName}} !</h1>
            <p class="text-xs md:text-sm mt-1 font-regular text-gray-900">{{ __('Transform Your Skin with JC\'s Skin Works: Unveiling Radiant Beauty through Expert Care and Tailored Treatments.') }}</p>
        </div>
    </div>    

    <div class="mb-6">
        @livewire('admin.landing-page.carouse-banner')
    </div>

    {{-- <div class="mt-10">
        <img src="{{asset('assets/Essentials/Services (1).png')}}" alt="">
    </div> --}}

    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row gap-4 mt-6">
            <a href="{{route('appointments')}}" class="flex items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 p-6 flex-grow">
                <img class="object-cover w-20 h-20 md:w-24 md:h-24 rounded-t-lg md:rounded-l-lg" src="{{asset('assets/Essentials/Calendar Schedule.png')}}" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-sm md:text-base font-bold tracking-tight text-gray-900 dark:text-white">My Appointments</h5>
                    <p class="mb-3 text-xs md:text-sm font-normal text-gray-700 dark:text-gray-400">View your appointments</p>
                </div>
            </a>
    
            <a href="{{route('services')}}" class="flex items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 p-6 flex-grow">
                <img class="object-cover w-20 h-20 md:w-24 md:h-24 rounded-t-lg md:rounded-r-lg" src="{{asset('assets/Essentials/avatar doctor.png')}}" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-sm md:text-base font-bold tracking-tight text-gray-900 dark:text-white">Services</h5>
                    <p class="mb-3 text-xs md:text-sm font-normal text-gray-700 dark:text-gray-400">View our services</p>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-span-12 mt-6">
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
            <div class="bg-white p-4 shadow-lg rounded-lg">
                <h1 class="font-bold text-base text-[#4FBD5E]">Appointments Today</h1>
                <div class="mt-4">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto">
                            <div class="py-2 align-middle inline-block min-w-full">
                                <div
                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                                            <tr>
                                                <th scope="col" class="px-6 py-6">
                                                    Appointment ID
                                                </th>
                                                <th scope="col" class="px-6 py-6">
                                                    Specialist
                                                </th>
                                                {{-- <th scope="col" class="px-6 py-6">
                                                    Date
                                                </th>
                                                <th scope="col" class="px-6 py-6">
                                                    Time
                                                </th> --}}
                                                <th scope="col" class="px-6 py-6">
                                                    Date & Time
                                                </th>
                                                <th scope="col" class="px-6 py-6">
                                                    Setting
                                                </th>
                                                <th scope="col" class="px-6 py-6">
                                                    ServiceS
                                                </th>
                                                <th scope="col" class="px-6 py-6">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($appointments as $appointment)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$appointment->id}}
                                                </td>
                                                <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $appointment->specialist )
                                                    <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $appointment->specialist->profile_photo_url }}" alt="{{ $appointment->specialist->name }}"> </div>
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium text-gray-900"> {{ $appointment->specialist->first_name .  " " . $appointment->specialist->last_name }} </div>
                                                        <div class="text-xs text-gray-500"> {{ $appointment->specialist->email }} </div>
                                                    </div>
                                                    @else
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900"> {{ $appointment->first_name . " " . $appointment->last_name }} </div>
                                                            {{-- <div class="text-xs text-gray-500"> {{ $appointment->email }} </div> --}}
                                                        </div>
                                                    @endif
                                                </th>
                                                <td class="px-6 py-6 whitespace-normal">
                                                    <div>
                                                        <div class="text-xs font-medium text-gray-900"> {{\Carbon\Carbon::parse($appointment->date)->format('M, d, Y')}} </div>
                                                        <div class="text-xs text-gray-500"> {{\Carbon\Carbon::parse($appointment->time)->format('g: i a')}} </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-6">
                                                    {{$appointment->setting}}
                                                </td>
                                                <td class="px-6 py-6 whitespace-normal">
                                                    {{$appointment->service->service_name}}
                                                </td>
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
                                </div>
                                <div class="mt-6">
                                    {{$appointments->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model.live="modalReview" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Feedback') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit='create'>
                @csrf
                <div>
                    <div class='w-full mb-4'>
                        <div class="rating rating-lg flex flex-col gap-2 items-center">
                            <x-label for="rating-4" value="{{ __('Please rate our service') }}" />
                            <div>
                                <input wire:model='rating' value="1" type="radio" name="rating-9" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" checked />
                                <input wire:model='rating' value="2" type="radio" name="rating-9" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" />
                                <input wire:model='rating' value="3" type="radio" name="rating-9" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" />
                                <input wire:model='rating' value="4" type="radio" name="rating-9" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" />
                                <input wire:model='rating' value="5" type="radio" name="rating-9" class="mask mask-star-2 bg-primary-green focus:text-primary-green text-primary-green" />
                            </div>
                        </div>
                    </div>
                    <div class='flex flex-col w-full'>
                        <div class='w-full'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                                <x-label for="" value="{{ __('Message') }}" />
                                <textarea wire:model='message' cols="30" rows="7" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" ></textarea>
                                <x-input-error for="message"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
    
            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='create'>
                {{ __('Submit') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="modalSucess" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Feedback') }}
        </x-slot>
    
        <x-slot name="content">
            <div class="flex flex-col items-center justify-center gap-4">
                <div>
                    <img src="{{asset('assets/Essentials/customer-experience.gif')}}" alt="" class="w-20 h-20">
                </div>
                <div>
                    <h1 class="font-medium text-lg">Feedback submitted</h1>
                </div>
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-button class="flex gap-2 ms-3" wire:click='closeModal' wire:loading.attr="disabled">              
                {{ __('Close') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
