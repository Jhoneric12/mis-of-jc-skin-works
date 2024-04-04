<div>
    <x-Essentials.page-title>Manage Inventory </x-Essentials.page-title>

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
        <div class="mb-4 flex gap-2 items-center justify-between">
            <div class="flex gap-2 items-center w-[80%]">
                <x-button class="flex gap-2" wire:click="openModal" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>                  
                    {{ __('Add New Stocks') }}
                </x-button>

                <div class="w-[30%]">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input wire:model.live='search' type='search' id="default-search" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Product" autocomplete="off">
                    </div>
                </div>

                {{-- <div class="w-[20%]">
                    <select wire:model.live='category' name="status" id="status" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm p-3">
                        <option value="All" selected>All Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select> 
                </div> --}}
                   

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
                        Product
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Expiration Date
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Action
                    </th>
                    {{-- <th scope="col" class="px-6 py-6">
                        Action
                    </th> --}}
                    
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
                    <td class="px-6 py-6">
                        {{$product->product->category->category_name}}
                    </td>
                    <td class="px-6 py-6">
                        {{$product->product->price}}
                    </td>
                    <td class="px-6 py-6">
                        {{\Carbon\Carbon::parse($product->expiration_date)->format('M, d, Y')}}
                    </td>
                    <td class="px-6 py-6">
                        {{$product->product->total_qty}}
                        @if($product->total_qty < $product->min_qty)
                            <span class="text-red-700 font-bold">!</span>
                        @endif
                    </td>
                    <td class="py-6 flex gap-2 text-center">
                        <svg wire:click='editExpiration({{$product->product_id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
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
            {{$products->links()}}
        </div>
    </div>

{{-- Add Modal --}}
<x-dialog-modal wire:model.live="modalAdd" maxWidth='lg'>
    <x-slot name="title">
        {{ __('Add Stocks') }}
    </x-slot> 

    <x-slot name="content">
        <form wire:submit='create'>
            @csrf
            <div>
                <div class='flex flex-col w-full'>
                    <div class='flex flex-col gap-1 mb-4 w-full'>
                        <x-label for="" value="{{ __('Product Name') }}" />
                        <select wire:model='product_id' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">- Select Options - </option>
                            @foreach ($items as $item)
                                @if ($item->status == true)
                                    <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-4">
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Quantity') }}" />
                            <input wire:model="total_quantity" type="number"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="total_quantity"/>
                        </div>
                    </div>
                    <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                        <x-label for="" value="{{ __('Expiration Date') }}" />
                        <input wire:model="exp_date" type="date"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <x-input-error for="exp_date"/>
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

{{-- Update Expiration Modal --}}
<x-dialog-modal wire:model.live="modalExpiration" maxWidth='lg'>
    <x-slot name="title">
        {{ __('Edit Expiration') }}
    </x-slot> 

    <x-slot name="content">
        <form wire:submit='create'>
            @csrf
            <div>
                <div class='flex flex-col w-full'>
                    <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                        <x-label for="" value="{{ __('Expiration Date') }}" />
                        <input wire:model="exp_date" type="date"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <x-input-error for="exp_date"/>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='updateExpiration'>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-dialog-modal>

{{-- View Modal --}}
{{-- <x-dialog-modal wire:model.live="modalView" maxWidth='lg'>
    <x-slot name="title">
        {{ __('Product Details') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit='updateCategory'>
            @csrf
            <div class="w-full">
                <div class='flex gap-4 w-full'>
                    <div class='flex flex-col gap-1 mb-4 text-fontColor w-full text-based font-semibold'>
                        <h1>Product ID : <span class="text-gray-400">{{$product_id}}</span></h1>
                        <h1 class="">Product Name : <span class="text-gray-400" wire:model='service_name'>{{$product_name}}</span></h1>
                        <h1 class="">Category : <span class="text-gray-400" wire:model='service_category_id'></span></h1>
                        <h1 class="">Price : <span class="text-gray-400"  wire:model='price'></span></h1>
                        <h1 class="">Quantity On Hand: <span class="text-gray-400" wire:model='min_qty'></span></h1>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Close') }}
        </x-secondary-button>
    </x-slot>
</x-dialog-modal> --}}
</div>