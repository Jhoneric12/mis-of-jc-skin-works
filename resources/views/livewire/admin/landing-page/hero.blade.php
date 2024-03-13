<div>
    <div class="flex justify-around w-full border border-solid items-center h-screen">
        <div class="md:w-[40%] w-full flex flex-col items-center md:items-start gap-4">
            <h1 class="text-gray-900 md:text-5xl md:text-left text-center text-3xl md:leading-[4rem] font-bold">{{$heroText}}</h1>
            <a href="{{url('register')}}" class="mt-4">
                <x-Essentials.button>Make Appointment</x-Essentials.button>
                {{-- <h1>{{$aboutUs}}</h1> --}}
            </a>
        </div>
        <div class="hidden md:flex">
            <img src="{{ asset('storage/' . $image) }}" alt="" class="w-[25rem] h-[25rem]">
        </div>
    </div>
</div>
