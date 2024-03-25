<div>
    <x-Essentials.page-title>Transaction History</x-Essentials.page-title>

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

    <div class="flex justify-between mb-6">
        <div></div>
        <div class="flex gap-4">
           <div class="flex gap-2 items-center">
               <label for="start_date" class="text-sm">From:</label>
               <input wire:model="startDate" wire:change="filterByDate" type="date" id="start_date" class="text-sm w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm p-3">
           </div>
          <div class="flex gap-2 items-center">
               <label for="end_date" class="text-sm">To:</label>
               <input wire:model="endDate" wire:change="filterByDate" type="date" id="end_date" class=" text-sm w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm p-3">
          </div>
       </div>
    </div>
    <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid">
        <div class="mb-4 flex gap-2 items-center justify-between">
            <div class="flex gap-2 items-center w-full">
                <a href="{{route("doctor-billing")}}">
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
                        <input wire:model.live='search' type='search' id="default-search" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Transaction" autocomplete="off">
                    </div>
                </div>
                
                <div class="w-[15%]">
                    <select wire:model.live='payment_mode' name="status" id="status" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm p-3">
                        <option value="All" selected>All</option>
                        <option value="CASH">Cash</option>
                        <option value="GCASH">GCash</option>
                        <option value="DEBIT CARD">Debit Card</option>
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
                        Transaction ID
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Recipient
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Date & Time
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Payment Mode
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$transaction->id}}
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $transaction->patient )
                        <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $transaction->patient->profile_photo_url }}" alt="{{ $transaction->patient->name }}"> </div>
                        <div class="ml-4">
                            <div class="text-xs font-medium text-gray-900"> {{ $transaction->patient->first_name .  " " . $transaction->patient->last_name }} </div>
                            <div class="text-xs text-gray-500"> {{ $transaction->patient->email }} </div>
                        </div>
                        @else
                            <div>
                                <div class="text-sm font-medium text-gray-900"> {{ $transaction->first_name . " " . $transaction->last_name }} </div>
                                {{-- <div class="text-xs text-gray-500"> {{ $appointment->email }} </div> --}}
                            </div>
                        @endif
                    </th>
                    <td class="px-6 py-6">
                        <div>
                            <div class="text-xs font-medium text-gray-900"> {{\Carbon\Carbon::parse($transaction->created_at)->format('M, d, Y')}} </div>
                            <div class="text-xs text-gray-500"> {{\Carbon\Carbon::parse($transaction->created_at)->format('g: i a')}} </div>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        {{$transaction->payment_mode}}
                    </td>
                    <td class="px-6 py-6">
                        {{$transaction->total_amount}}
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
            {{$transactions->links()}}
        </div>
    </div>
</div>
