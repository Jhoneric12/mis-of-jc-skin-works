<div>
    <div class="flex gap-4">
        <a href="{{route('contents')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">Configure Page</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-[#9D9D9D]"> > </x-Essentials.page-title>
        <x-Essentials.page-title>Dermatologist</x-Essentials.page-title>
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

    {{-- <form class="bg-white rounded-lg shadow-md p-16 border-t-4 border-t-solid border-t-[green]" wire:submit='update'>
        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
            <x-label for="" value="{{ __('Name') }}" />
            <input wire:model="name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <x-input-error for="name"/>
        </div>
        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
            <x-label for="" value="{{ __('Image') }}" />
            <input wire:model="image" type="file" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <x-input-error for="image"/>
        </div>
        <div class="flex items-center justify-center mt-8">
            <img src="{{ asset('storage/' . $image) }}" alt="" class="w-60 h-60 border-2 border-solid border-[green] shadow-md">
        </div>
        <div class="flex justify-between mt-8">
            <div></div>
            <div class="flex items-center">
                <div role="status" wire:loading>
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                <x-button class="ms-3" wire:loading.attr="disabled" type='submit'>
                    {{ __('Save') }}
                </x-button>
            </div>
        </div>
    </form> --}}

    <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                <tr>
                    <th scope="col" class="px-6 py-6">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-6">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-6 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dermatologists as $dermatologist)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img src="{{ asset('storage/' . $dermatologist->image_path) }}" alt="" class="w-14 h-14">
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$dermatologist->id}}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$dermatologist->name}}
                    </td>
                    <td class="py-8 flex gap-2 items-center justify-center">
                        <button wire:click='editModal({{$dermatologist->id}})' class='navigate flex items-center justify-center bg-[green] py-1 text-[white] w-[3rem] font-bold outline-none rounded-[4px] hover:bg-opacity-90'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
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
    </div>

    <x-dialog-modal wire:model.live="modalUpdate" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Edit Dermatologist') }}
        </x-slot> 
    
        <x-slot name="content">
            <form wire:submit='update'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Dermatologist Name') }}" />
                            <input wire:model="name" type="text" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-input-error for="name"/>
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
</div>
