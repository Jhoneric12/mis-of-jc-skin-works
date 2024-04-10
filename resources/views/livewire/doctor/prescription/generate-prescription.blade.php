<div>
    <x-Essentials.page-title>Generate Prescription</x-Essentials.page-title>

    <form wire:submit.prevent='generate' class='bg-gray-50 p-10 border border-solid border-t-4 border-t-[#5FC26C] border-t-solid shadow-md rounded-lg'>
        @csrf
        <h1 class="text-[6rem]">℞</h1>
        <div class='w-full'>
            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                <div class="flex gap-4">
                    <div class='flex flex-col gap-1 text-fontColor w-full'>
                        <div class='flex flex-col gap-1 mb-4 text-fontColor w-full'>
                            <x-label for="" value="{{ __('Patient Name') }}" />
                            <select wire:model='patient_id' class='mt-1 border-gray-300 focus:border-[#4FBD5E] focus:ring-green-500 rounded-md shadow-sm'>
                                <option  value="">- Select Options - </option>
                                @foreach ($patients as $patient)
                                    @if ($patient->account_status == true)
                                        <option value="{{ $patient->id }}">ID : {{$patient->id}} - {{ $patient->first_name . " " . $patient->last_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error for="patient_id"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='w-full'>
            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                <x-label for="" value="{{ __('Medication') }}" />
                <textarea wire:model='medication' cols="30" rows="6" name="skintype" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"></textarea>
                <x-input-error for="medication"/>
            </div>
        </div>
        <div class='w-full'>
            <div class='flex flex-col gap-1 mb-4 text-fontColor'>
                <x-label for="" value="{{ __('Description') }}" />
                <textarea wire:model='description' cols="30" rows="8" name="skintype" class="w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"></textarea>
                <x-input-error for="description"/>
            </div>
        </div>
        <div class='mb-4'>
            <p class='text-[red] text-xs'></p>
        </div>
        <div class='flex justify-end mt-6 items-center'>

            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>

            <button type="submit" class="text-sm text-center bg-[#4FBD5E] hover:opacity-90 text-white px-4 py-3 rounded-[8px] flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                <h1>Generate</h1>
            </button>
        </div>
    </form>
</div>
