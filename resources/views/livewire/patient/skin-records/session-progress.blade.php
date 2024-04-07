<div>
    <div class="flex gap-4">
        <a href="{{route('skin-records')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">My History</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title> > </x-Essentials.page-title>
        <x-Essentials.page-title>Session Progress</x-Essentials.page-title>
   </div>

   <div class="flex justify-between items-center ">
        <div class="flex flex-col gap-2 items-start md:flex-row">
            <h1 class="font-bold text-md text-gray-700 mr-2">{{$no_of_session->service->service_name}}</h1>
            <div class="flex flex-row gap-1">
                <span class="text-green-600 text-sm md:text-base font-bold">( {{$no_of_progress}}</span>
                <span class="text-green-600 text-sm md:text-base font-bold">/</span>
                <span class="text-green-600 text-sm md:text-base font-bold">{{$no_of_session->service->nno_of_sessions}} )</span>
            </div>
            {{-- <span class="text-green-600 font-bold">{{$no_of_session->service->nno_of_sessions}}</span> --}}
        </div>
        {{-- <div class="flex gap-2 items-center">
            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <div class="flex gap-4 items-center" @if($no_of_progress === $no_of_session->service->nno_of_sessions || !$isProceed) style="display: none;" @endif>
                <x-secondary-button class="flex gap-2" wire:click="openReSchedule" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                    </svg>                       
                    {{ __('Next Session') }}
                </x-button>
                <x-button class="flex gap-2" wire:click="openModal" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                    </svg>                       
                    {{ __('Add New') }}
                </x-button>
            </div>
        </div> --}}
    </div>

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">
        @php
        $sessionNumber = 1;
        @endphp
        @forelse ($sessions as $session)
            <div class="rounded-lg shadow-md bg-white">
                <div class="flex justify-between items-center w-full p-4 border-b border-solid border-b-gray-300 font-semibold">
                    <div>
                        {{ $sessionNumber === 1 ? 'First' : ($sessionNumber === 2 ? 'Second' : ($sessionNumber === 3 ? 'Third' : ($sessionNumber . 'th'))) }} Session
                    </div>
                </div>
                <div class="p-6 flex flex-col sm:flex-row md:flex-col lg:flex-col xl:flex-col gap-4">
                    <div><img src="{{ asset('storage/' . $session->image_path) }}" alt="" class="rounded-md w-full h-[15rem] sm:w-full"></div>
                    <div class="flex flex-col">
                        <div>
                            <div class="font-semibold text-md">Dr. {{$session->specialist}}</div>
                            <div class="text-xs">Doctor/Staff</div>
                        </div>
                        {{-- <div class="mt-2 sm:mt-0 md:mt-0 lg:mt-0 xl:mt-0">
                            <div class="font-semibold text-md">{{\Carbon\Carbon::parse($session->created_at)->format('M, d, Y')}}</div>
                            <div class="text-xs">Date</div>
                        </div> --}}
                    </div>
                </div>
            </div>
            @php
                $sessionNumber++;
            @endphp
        @empty
            <div class='flex justify-center items-center rounded-lg p-4 w-full'>
                <div class="flex flex-col items-center justify-center w-full">
                    <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-40 w-40">
                    <h1 class="text-md font-semibold mb-2">No Session Found</h1>
                </div>
            </div>  
        @endforelse
    </div>
    


</div>
