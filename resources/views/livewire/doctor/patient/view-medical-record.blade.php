<div>
    <x-Essentials.page-title>Medical Record</x-Essentials.page-title>

    <div class="flex justify-center">
        <div class="paper bg-white shadow-md p-10 w-[80%]">
            <div class="flex justify-between items-center">
                <h1 class="text-[#5FC26C] text-2xl font-bold mb-6">Patient Medical Information</h1>
                <div>
                    <x-button class="flex gap-2 bg-red-500" wire:click='export'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                        </svg>                                       
                        {{ __('Export') }}
                    </x-button>
                </div>
            </div>
            <div>
                <div class="patient-informaion ">
                    <h1 class=" text-[#5FC26C] mb-4">Patient Information</h1>
                    <div class="flex-col">
                        <div class="mb-4">
                            <p>{{$fullname}}</p>
                        </div class="mb-4">
                        <div class="mb-4">
                            <p>{{$contact_number}}</p>
                        </div>
                        <div class="mb-4">
                            <p>{{$email}}</p>
                        </div>
                        <div class="mb-4">
                            <p>{{$home_address}}</p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="patient-informaion">
                    <h1 class=" text-[#5FC26C] mb-4">Skin Type</h1>
                    <div class="flex-col">
                        <div class="mb-4">
                            <p>{{$skintype}}</p>
                        </div class="mb-4">
                    </div>
                </div>
                <div class="medication_allergies mt-6">
                    <div class=" py-2 border-b border-b-solid border-b-red-500">
                        <h1 class="text-red-500 text-lg font-bold">Medication Allergies</h1>
                    </div>
                    <div class="py-6">
                        <p>{{$medication_allergies}}</p>
                    </div>
                </div>
                <div class="findings mt-6">
                    <div class=" py-2 border-b border-b-solid border-b-[#5FC26C]">
                        <h1 class="text-[#5FC26C] text-lg font-bold">Findings</h1>
                    </div>
                    <div class="py-6">
                        <p>{{$findings}}</p>
                    </div>
                </div>
                <div class="findings">
                    <div class=" py-2 border-b border-b-solid">
                        <h1 class="text-[6rem] font-bold">℞</h1>
                    </div>
                    <div class="py-6">
                        <p>{{$prescription}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
