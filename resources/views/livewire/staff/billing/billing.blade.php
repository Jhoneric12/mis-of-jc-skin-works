<div>
    <x-Essentials.page-title>Billing</x-Essentials.page-title>

    {{-- Added Message --}}
    @if(Session::has('checkout'))
        <div id="alert-success" class="flex items-center p-4 mb-4 rounded-lg bg-green-500 text-white  dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium text-white">
                {{Session::get('checkout')}}
            </div>
        </div>
    @endif

    <div>
        <div class="flex flex-col gap-4 bg-gray-50 px-6 py-4 rounded-lg shadow-md mb-6">
            <div class="w-full">
                <h1 class="text-sm font-bold mb-4">Recipient</h1>
            </div>
           <div class="flex gap-4">
            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                    <div class="flex gap-4 items-center">
                        <x-label for="" value="{{ __('Patient ID') }}" />
                        <span class="text-red-500 text-xs"> *Press enter to search patient</span>
                    </div>
                    <div class="relative" >
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input wire:model.live='patient_id' wire:keydown.enter='searchPatient' type='search' id="default-search-services"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ps-10" autocomplete="off">
                    </div>
                    <x-input-error for="patient_id"/>
                </div>
                <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                    <x-label for="" value="{{ __('Patient Name') }}" />
                    <input readonly wire:model="patient_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
           </div>
        </div>
        <div class="mb-6">
            <h1 class="text-md font-bold">Choose Products and Services</h1>
        </div>
        <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid">
            <div class="mb-4">
                <h1 class="font-bold text-md">Products</h1>
            </div>
            <div class="mb-4 flex gap-2 items-center justify-between">
                <div class="flex gap-2 items-center w-[80%]">
                    <div class="w-[30%]">   
                        <label for="default-search-products" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search Products</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input wire:model.live='search' type='search' id="default-search-products" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Product Name" autocomplete="off">
                        </div>
                    </div>
    
                    <div role="status" wire:loading>
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                    <tr>
                        <th scope="col" class="px-6 py-6">
                            Product
                        </th>
                        {{-- <th scope="col" class="px-6 py-6">
                            Category
                        </th> --}}
                        <th scope="col" class="px-6 py-6">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Expiration Date
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Quantity On Hand
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Action
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                        <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ asset('storage/' . $product->product->product_image_path) }}" alt="{{ $product->product->product_name }}" class="rounded-full h-10 w-10 object-cover">  
                            <div class="ps-3">
                                <div class="text-xs font-semibold">{{$product->product->product_name}}</div>
                                <div class="text-xs font-normal text-gray-500">{{$product->id}}</div>
                            </div>
                        </th>
                        {{-- <td class="px-6 py-6">
                            {{$product->product->category->category_name}}
                        </td> --}}
                        <td class="px-6 py-6">
                            {{$product->product->price}}
                        </td>
                        <td class="px-6 py-6">
                            {{\Carbon\Carbon::parse($product->expiration_date)->format('M, d, Y')}}
                        </td>
                        <td class="px-6 py-6">
                            {{$product->product->total_qty}}
                        </td>
                        <td class="px-6 py-6">
                            <div>
                                <div class="flex">
                                    <input wire:model='quantity' type="number" class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white text-sm" placeholder="Qty" value="1">
                                    @error('quantity')
                                        <div class="text-red-500 text-xs ml-4">{{ $message }}</div>
                                    @enderror
                                    <button wire:click="addToCart({{ $product->id }}, 'product')" class="px-8 rounded-r-lg bg-[#5FC26C] text-gray-200 text-sm font-bold p-2  border-[#5FC26C] border-t border-b border-r">Add to Cart</button>
                                </div>
                            </div>
                        </td>
                        
                        {{-- <td class="py-6 flex gap-2">
                            <svg wire:click='view({{$product->id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>                          
                        </td> --}}
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
    
            {{-- <div class="mt-6">
                @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{$products->links()}}
                @endif
            </div> --}}
        </div>
    
        <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid mt-8">
            <div class="mb-4">
                <h1 class="font-bold text-md">Services</h1>
            </div>
            <div class="mb-4 flex gap-2 items-center justify-between">
                <div class="flex gap-2 items-center w-[80%]">
                    <div class="w-[30%]">   
                        <label for="default-search-services" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search Services</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input wire:model.live='serviceSearch' type='search' id="default-search-services" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Service Name" autocomplete="off">
                        </div>
                    </div>
    
                    <div role="status" wire:loading>
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                    <tr>
                        <th scope="col" class="px-6 py-6">
                            Service ID
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Service Name
                        </th>
                        {{-- <th scope="col" class="px-6 py-6">
                            Category
                        </th> --}}
                        <th scope="col" class="px-6 py-6">
                            Price
                        </th>
                        {{-- <th scope="col" class="px-6 py-6">
                            Status
                        </th> --}}
                        <th scope="col" class="px-6 py-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$service->id}}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$service->service_name}}
                        </td>
                        {{-- <td class="px-6 py-6">
                            {{$service->category->category_name}}
                        </td> --}}
                        <td class="px-6 py-6">
                            {{$service->price}}
                        </td>
                        {{-- <td class="px-6 py-6">
                            <span class="{{ $service->status == false ? 'bg-red-300 text-red-800 text-xs' : 'bg-green-300 text-green-800 text-xs' }} px-2 py-1 rounded-full text-white">
                                {{ $service->status ? 'Active' : 'Inactive'}}
                            </span>
                        </td> --}}
                        <td class="px-6 py-6">
                            <div>
                                <div class="flex">
                                    <input wire:model='quantity' type="number" class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white text-sm" placeholder="Qty" value="1">
                                    <button wire:click="addToCart({{ $service->id }}, 'service')" class="px-8 rounded-r-lg bg-[#5FC26C] text-gray-200 text-sm font-bold p-2  border-[#5FC26C] border-t border-b border-r">Add to Cart</button>
                                </div>
                            </div>
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
    
            {{-- <div class="mt-6">
                @if($services instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{$services->links()}}
                @endif
            </div> --}}
        </div>

        <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid mt-8">
            <div class="mb-4">
                <h1 class="font-bold text-md">Promotions</h1>
            </div>
            <div class="mb-4 flex gap-2 items-center justify-between">
                <div class="flex gap-2 items-center w-[80%]">
                    <div class="w-[30%]">   
                        <label for="default-search-services" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search Services</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input wire:model.live='promoSearch' type='search' id="default-search-services" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Promotion" autocomplete="off">
                        </div>
                    </div>
    
                    <div role="status" wire:loading>
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                    <tr>
                        <th scope="col" class="px-6 py-6">
                            Promo ID
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Promo Name
                        </th>
                        {{-- <th scope="col" class="px-6 py-6">
                            Category
                        </th> --}}
                        <th scope="col" class="px-6 py-6">
                            Price
                        </th>
                        {{-- <th scope="col" class="px-6 py-6">
                            Status
                        </th> --}}
                        <th scope="col" class="px-6 py-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($promos as $promo)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$promo->id}}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$promo->promo_name}}
                        </td>
                        {{-- <td class="px-6 py-6">
                            {{$service->category->category_name}}
                        </td> --}}
                        <td class="px-6 py-6">
                            {{$promo->price}}
                        </td>
                        {{-- <td class="px-6 py-6">
                            <span class="{{ $service->status == false ? 'bg-red-300 text-red-800 text-xs' : 'bg-green-300 text-green-800 text-xs' }} px-2 py-1 rounded-full text-white">
                                {{ $service->status ? 'Active' : 'Inactive'}}
                            </span>
                        </td> --}}
                        <td class="px-6 py-6">
                            <div>
                                <div class="flex">
                                    <input wire:model='quantity' type="number" class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white text-sm" placeholder="Qty" value="1">
                                    <button wire:click="addToCart({{ $promo->id }}, 'promotion')" class="px-8 rounded-r-lg bg-[#5FC26C] text-gray-200 text-sm font-bold p-2  border-[#5FC26C] border-t border-b border-r">Add to Cart</button>
                                </div>
                            </div>
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
    
            {{-- <div class="mt-6">
                @if($services instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{$services->links()}}
                @endif
            </div> --}}
        </div>

        <div class="mt-6">
            <h1 class="text-md font-bold">Point of Sale</h1>
        </div>


        <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid mt-6 ">
            <div class="mb-4">
                <h1 class="font-bold text-md mb-6">Cart</h1>
            </div>
        
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                    <tr>
                        <th scope="col" class="px-6 py-6">
                            Particulars
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Sub Total
                        </th>
                        <th scope="col" class="px-6 py-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cart as $index => $item)
                        <tr>
                            <td class="px-6 py-6">{{ $item['name'] }}</td>
                            <td class="px-6 py-6">{{ $item['type'] }}</td>
                            {{-- <td class="px-6 py-6">{{ $item['unit_price'] }}</td> --}}
                            <td class="px-6 py-6">{{ $item['quantity'] }}</td>
                            <td class="px-6 py-6">{{ $item['subtotal'] }}</td>
                            <td class="px-6 py-6">
                                <button wire:click="removeFromCart({{ $index }})" class="px-2 py-2 rounded-lg bg-red-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white text-sm">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                      </svg>
                                      
                                </button>
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
    
            <div class="flex justify-between mt-6">
                <div>
                </div>
        
                <div class="flex flex-col items-end gap-4">
                    <x-label for="" value="{{ __('Total Amount') }}" />
                    <div class=" px-10 py-3 border border-solid border-[#5FC26C] bg-[#F0F5EB] text-[#5FC26C]">{{ $cartTotal }}</div>
                    <div class='flex items-end flex-col gap-1 mb-4 text-fontColor'>
                        <div role="status" wire:loading>
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        <x-label for="" value="{{ __('Discount') }}" />
                        <input wire:model="discount" wire:keydown.enter='computeDiscount' type="number" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <span class="text-red-500 text-xs"> *Press enter to compute discount</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <div>
                </div>
        
            </div>
    
            <div class="mt-8">
                <h1 class="font-bold text-md">Sales Invoice</h1>
                <div class="mt-4">
                    <div>
                        <label for="" class="text-[#5FC26C] text-sm">Billing User</label>
                        <h1 class="text-base">{{Auth::user()->first_name . " " . Auth::user()->last_name}}</h1>
                    </div>
                </div>
                <div class="flex flex-col gap-4 items-center bg-gray-50 dark:bg-gray-700 border border-solid border-gray-200 dark:border-gray-600 rounded-lg py-4 px-6 mt-4">
                    <div class="flex flex-col gap-1 w-full">
                        <div class="w-full">
                            <h1 class="text-sm font-bold mb-4">Checkout Details</h1>
                        </div>
                        <div class="w-full">
                            <div class="flex gap-4">
                                <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                    <x-label for="" value="{{ __('Amount to be paid') }}" />
                                    <input wire:model="total_amount" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ number_format(array_sum(array_column($cart, 'total')), 2) }}" readonly>
                                    <x-input-error for="total_amount"/>
                                </div>
                                <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                    <x-label for="" value="{{ __('Payment Mode') }}" />
                                    <select wire:model.live='payment_mode' name="status" id="status" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <option value="" selected>Select Options</option>
                                        <option value="GCASH">GCash</option>
                                        <option value="CASH">Cash</option>
                                        <option value="DEBIT CARD">Debit Card</option>
                                    </select>
                                    <x-input-error for="payment_mode"/>
                                </div>
                            </div>
                        </div>
                        <div class="w-full" @if($payment_mode !== 'CASH') style="display:none" @endif>
                            <div class="flex gap-4">
                                <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                    <div class="flex gap-4 items-center">
                                        <x-label for="" value="{{ __('Cash Rendered') }}" />
                                        <span class="text-red-500 text-xs"> *Press enter to compute change</span>
                                    </div>
                                    <input wire:model="cash_rendered" wire:keydown.enter="computeChange" type="number" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-input-error for="cash_rendered"/>
                                </div>
                                <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                    <x-label for="" value="{{ __('Change') }}" />
                                    <input wire:model="change" readonly type="number" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$change}}">
                                    <x-input-error for="change"/>
                                </div>
                            </div>
                        </div>
                        <div class="w-full" @if($payment_mode !== 'GCASH' && $payment_mode !== 'DEBIT CARD') style="display:none" @endif>
                            <div class="flex gap-4">
                                <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                    <x-label for="" value="{{ __('Reference No.') }}" />
                                    <input wire:model="ref_no"  type="number" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$change}}">
                                    <x-input-error for="ref_no"/>
                                </div>
                            </div>
                        </div>
                    </div> 
    
                    <div class="flex justify-between w-full">
                        <div>
                        </div>
                        <div class="flex gap-4 items-center">
                            <div role="status" wire:loading>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            <x-button class="flex gap-2" wire:click="overview" wire:confirm='Are you sure you want to checkout?' wire:loading.attr="disabled">              
                                {{ __('Checkout') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Invoice Overview --}}
    <x-dialog-modal wire:model.live="modalView" maxWidth='2xl'>
        <x-slot name="title">
            {{ __('Invoice Overview') }}
        </x-slot>
    
        <x-slot name="content">
            <!-- Invoice Table -->
            <div class="overflow-x-auto p-6">
                <div class="text-center mb-10">
                    <h1 class="text-lg font-bold">Jc's Skin Works Dermatology Clinic</h1>
                    <h1 class="text-sm">Official Receipt</h1>
                </div>
                <div class="mb-6">
                    <div class="flex flex-col gap-1">
                        <div>
                            <h1 class="font-medium">Order No: <span>{{$order_no}}</span></h1>
                        </div>
                        
                        <div>
                            <h1 class="font-medium">Patient ID: <span>{{$patient_id}}</span></h1>
                        </div>

                        <div>
                            <h1 class="font-medium">Patient Name: <span>{{$patient_name}}</span></h1>
                        </div>
                        
                    </div>
                </div>
                <div role="status" class="mb-4" wire:loading>
                    <svg aria-hidden="true" class="w-5 h-5 mr-4 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                <table class="table-auto w-full border-collapse border border-green-400">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-[#4FBD5E] text-white text-left">Particulars</th>
                            <th class="px-4 py-2 bg-[#4FBD5E] text-white text-left">Quantity</th>
                            <th class="px-4 py-2 bg-[#4FBD5E] text-white text-left">Unit Price</th>
                            <th class="px-4 py-2 bg-[#4FBD5E] text-white text-left">Sub-Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach($cart as $index => $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item['name'] }}</td>
                                <td class="border px-4 py-2">{{ $item['quantity'] }}</td>
                                <td class="border px-4 py-2">{{ number_format($item['total'] / $item['quantity'], 2) }}</td>
                                <td class="border px-4 py-2">{{ $item['subtotal'] }}</td>
                            </tr>
                        @endforeach
                        <!-- Total row -->
                        <tr>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2 text-right"><strong>Discount</strong></td>
                            <td class="border px-4 py-2">{{ number_format($discount, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2 text-right"><strong>Total</strong></td>
                            <td class="border px-4 py-2">{{ number_format($total_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2 text-right"><strong>Payment Mode</strong></td>
                            <td class="border px-4 py-2">{{ $payment_mode }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-6">
                    <div class="flex flex-col gap-1">
                        <div class="flex gap-2">
                            <h1 class="font-medium text-[#4FBD5E]">Billing User:</h1>
                            <span>{{Auth::user()->first_name . " " . Auth::user()->last_name}}</span>
                        </div> 
                        <div class="flex gap-2">
                            <h1 class="font-medium text-[#4FBD5E]">Date:</h1>
                            <span>{{ \Carbon\Carbon::today()->format('F j, Y') }}</span>
                        </div> 
                    </div>
                </div>

                {{-- <h1>{{$order_no}}</h1> --}}
                {{-- <h1>{{$patient_id}}</h1>
                <h1>{{$cash_rendered}}</h1>
                <h1>{{$change}}</h1>
                <h1>{{$payment_mode}}</h1> --}}
            </div>
    
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
            <x-button class="flex gap-2 ms-3" wire:click='printInvoice' wire:loading.attr="disabled">              
                {{ __('Print Invoice') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="modalSucess" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Transaction Completed') }}
        </x-slot>
    
        <x-slot name="content">
            <div class="flex flex-col items-center justify-center gap-4">
                <div>
                    <img src="{{asset('assets/Essentials/delivery-completed.gif')}}" alt="" class="w-20 h-20">
                </div>
                <div>
                    <h1 class="font-medium text-lg">Transaction Completed</h1>
                </div>
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-button class="flex gap-2 ms-3" wire:click='proceedToSession' wire:loading.attr="disabled">              
                {{ __('Proceed') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="modalError" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Checkout error') }}
        </x-slot>
    
        <x-slot name="content">
           <h1>Recipient details is required</h1>
        </x-slot>
    
        <x-slot name="footer">
            <x-button class="flex gap-2 ms-3" wire:click='closeModal' wire:loading.attr="disabled">              
                {{ __('Ok') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
    

    
</div>

<script>
    setTimeout(function() {
            document.getElementById('alert-success').style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
</script>
