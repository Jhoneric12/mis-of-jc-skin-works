<div>
    <div class="flex gap-4">
        <a href="{{route('contents')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">Configure Page</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-[#9D9D9D]"> > </x-Essentials.page-title>
        <x-Essentials.page-title>Featured Products </x-Essentials.page-title>
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
        <div class="mb-4 flex gap-2 items-center justify-between w-full">
            <div></div>
            <div class="flex gap-2 items-center">
                <x-button class="flex gap-2" wire:click="openModal" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>                  
                    {{ __('Add New') }}
                </x-button>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                <tr>
                    <th scope="col" class="px-6 py-6">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Product ID
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Product Name
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Product Description
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
                @forelse ($products as $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img src="{{ asset('storage/' . $product->product_image_path) }}" alt="" class="w-14 h-14">
                    </td>
                    <td scope="row" class="px-6 py-4   whitespace-normal dark:text-white">
                        {{$product->id}}
                    </td>
                    <td scope="row" class="px-6 py-4   whitespace-normal dark:text-white">
                        {{$product->product_name}}
                    </td>
                    <td scope="row" class="px-6 py-4   whitespace-normal dark:text-white">
                        {{$product->description}}
                    </td>
                    <td class="px-6 py-6">
                        <span class="{{ $product->status == false ? 'bg-red-300 text-red-800 text-xs' : 'bg-green-300 text-green-800 text-xs' }} px-2 py-1 rounded-full text-white">
                            {{ $product->status ? 'Active' : 'Inactive'}}
                        </span>
                    </td>
                    <td class="py-6 flex gap-2 items-center">                        
                        <svg wire:click='editModal({{$product->id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <svg wire:click='editImage({{$product->id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>    
                        <svg wire:click='editStatus({{$product->id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
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
            {{$products->links()}}
        </div>
    </div>

    {{-- Add Modal --}}
    <x-dialog-modal wire:model.live="modalAdd" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Add Featured Products') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit='create'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Product Name') }}" />
                            <input wire:model="product_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="product_name"/>
                        </div>
                        <div class='w-full'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                                <x-label for="" value="{{ __('Description') }}" />
                                <textarea wire:model='description' cols="30" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Description' '></textarea>
                                <x-input-error for="description"/>
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
            {{ __('Edit Featured Product for ' . $product_name) }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit='update'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Product Name') }}" />
                            <input wire:model="product_name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="product_name"/>
                        </div>
                        <div class='w-full'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                                <x-label for="" value="{{ __('Description') }}" />
                                <textarea wire:model='description' cols="30" rows="7" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder='Enter Description' '></textarea>
                                <x-input-error for="description"/>
                            </div>
                        </div>
                        {{-- <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Image') }}" />
                            <input wire:model="image" type="file"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="image"/>
                        </div> --}}
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

     {{-- Update Image --}}
     <x-dialog-modal wire:model.live="modalImage" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Edit Image for ' . $product_name) }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit='updateStatus'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class="flex gap-4">
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                                <x-label for="" value="{{ __('Image') }}" />
                                <input wire:model="image" type="file"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="image"/>
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

            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='updateImage'>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Update Status --}}
    <x-dialog-modal wire:model.live="modalStatus" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Edit Status for ' . $product_name) }}
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
